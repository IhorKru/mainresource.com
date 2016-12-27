<?php

namespace AppBundle\Services;

use AppBundle\Entity\Campaigns;
use AppBundle\Entity\Lists;
use AppBundle\Entity\Subscriber;
use AppBundle\Entity\SubscriberAddress;
use AppBundle\Entity\SubscriberADKCampaign;
use AppBundle\Entity\SubscriberADKCampErrors;
use AppBundle\Entity\SubscriberDetails;
use AppBundle\Entity\SubscriberOptInDetails;
use AppBundle\Entity\Subscribers;
use DateTime;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use SimpleXMLElement;
use Symfony\Component\DomCrawler\Crawler;

#sendy entities

class ADKController extends FOSRestController 
{

    private $numcampaigns;
    private $timezone;
    private $depdate;

    public function adkAction($numcampaigns, $timezone, $depdate)
    {
    	# 1a. Configuration setup for connecting to ADK
        $list_id = '23413';
        $sub_id = 'test_sub_id';
        $token = '305c7c5be78b5c8dd583312fe20578ac';
        $url = 'http://integrated.adstation.com/1.3';

        $randnum = rand(0,1);

        # define click and image domains based on resource id
        if ($randnum >= 0 AND $randnum < 0.1) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.1 AND $randnum < 0.2) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.2 AND $randnum < 0.3) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.3 AND $randnum < 0.4) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.4 AND $randnum < 0.5) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.5 AND $randnum < 0.6) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.6 AND $randnum < 0.7) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.7 AND $randnum < 0.8) {
            $idomain = 'img.relaxst.com';
            $cdomain = 'click.relaxst.com';
        } elseif ($randnum >= 0.8 AND $randnum < 0.9) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        } elseif ($randnum >= 0.9) {
            $idomain = 'adk.mediaff.com';
            $cdomain = 'adk.mediaff.com';
        }

        #definition of variables
        $subscriber = new SubscriberDetails();
        $address = new SubscriberAddress();
        $optindetails = new SubscriberOptInDetails();
        $subscriber ->getAddressdetail() ->add($address);
        $subscriber ->getOptindetails() ->add($optindetails);

        //$subscribers = array();
        $subscribersB = array();
        //$subscribersBS = array();
        $xmlarray = array();

        $em = $this ->getDoctrine() ->getManager();
        $ent = $this->getDoctrine() ->getRepository('AppBundle:SubscriberDetails');
        $templaterepo = $this->getDoctrine()->getRepository('AppBundle:Template');
        $adkent = $this->getDoctrine() ->getRepository('AppBundle:SubscriberADKCampaign');
        $adkcategoryrepo = $this->getDoctrine() ->getRepository('AppBundle:RefADKCategoryDetails');
        $sendyappdetails = $this->getDoctrine() ->getRepository('AppBundle:SendyApps');

        # 1b. Select data that matches required creteria
        # which are:
            # subscribers that did not receive email from Mediaff for the last 7 days
            # subscribers that never received email from mediaff

        $qb = $em ->createQueryBuilder();

        # this is sub query to include into camapaign subscribers, that where never emailed too by Mediaff.com and used in the qb query
            $qb2 = $em ->createQueryBuilder();
            $qb2
                -> select('t')
                -> from('AppBundle\Entity\SubscriberADKCampaign', 't')
                -> where('s.emailaddress = t.recipient')
            ;
        # primary query to select users for future campaigns
        $qb
            -> select('s')
            -> from('AppBundle\Entity\SubscriberDetails', 's')
            -> LeftJoin('AppBundle\Entity\SubscriberADKCampaign', 'c', \Doctrine\ORM\Query\Expr\Join::WITH, 's.emailaddress = c.recipient')
            -> Where(':todaydate - c.datecreated >= 7')
            -> orWhere($qb->expr()->not($qb->expr()->exists($qb2->getDQL())))
            -> setMaxResults($numcampaigns)
            -> setParameters(array('todaydate' => new DateTime()))
        ;
        $subscribers = '';
        $subscribers = $qb ->getQuery() ->getResult();

        # batching big array of data
        if (is_array($subscribers)) {
            $subscribersB = array_chunk($subscribers, 500, true);
        }

        if(is_array($subscribersB)) {
            #processing first level batch
            foreach ($subscribersB as $subscriberBS) {
                $xml = '';
                $query = '';
                foreach ($subscriberBS as $subscriber) {
                    $email = $subscriber ->getEmailaddress();
                    $gender = $subscriber ->getGender();
                    $isocountry = $address ->getIsocountrycode();
                    $metrocode = $address ->getRefgeoid();
                    $state = $address ->getCity();
                    $postalcode = $address ->getPostalcode();

                    $md5_email = md5(strtolower($email));
                    $email_hashes[$md5_email] = $email;
                    $email_domain = strtolower(preg_replace('/.*\@/','',$email));
                    $xml .= "<email>"
                             . "<recipient>$md5_email</recipient>"
                             . "<list>$list_id</list>"
                             . "<domain>$email_domain</domain>"
                             . "<countrycode>$isocountry</countrycode>"
                             . "<metrocode>$metrocode</metrocode>"
                             . "<postalcode>$postalcode</postalcode>"
                             . "<gender>$gender</gender>"
                             . "<test>0</test>"
                          . "</email>";
                }
                #preparing xml string
                $xml = '<request>' . $xml . '</request>';
                $request = urlencode($xml);
                $query  = 'Accept-Encoding: gzip' .'&';
                $query .= 'token=' . $token . '&';
                $query .= 'subid=' . $sub_id . '&';
                $query .= 'idomain=' . $idomain . '&';
                $query .= 'cdomain=' . $cdomain . '&';
                $query .= 'request=' . $request .'&';
                $query .= 'test=1';

                array_push($xmlarray, $query);
            }
        }
        // array of curl handles
        $curly = array();
        // data to be returned
        $result = array();
        // multi handle
        $mh = curl_multi_init();
        #query data for each of sub queries on the $xmlarray
        foreach ($xmlarray as $id => $d) {
            $curly[$id] = curl_init();
            curl_setopt($curly[$id], CURLOPT_URL, $url);
            curl_setopt($curly[$id], CURLOPT_POST, true);
            curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d);
            curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curly[$id], CURLOPT_TIMEOUT, 60);
            curl_setopt($curly[$id], CURLOPT_SSLVERSION, 3);
            curl_multi_add_handle($mh, $curly[$id]);
        }
        // execute the handles
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while($running > 0);
        // get content and remove handles
        foreach($curly as $id => $c) {
            $result[$id] = curl_multi_getcontent($c);
            curl_multi_remove_handle($mh, $c);
        }
        // all done
        curl_multi_close($mh);

        $xmlresponse = array();
        $xmlerror = array();
        $subcreative = array();
        $querybatch = $em ->createQuery('SELECT MAX(s.batchnum) FROM AppBundle:SubscriberADKCampaign s');
        $curbatch = $querybatch->getSingleScalarResult() + 1;

        foreach ($result as $id => $xmlbatch) {
            $xml = new SimpleXMLElement($xmlbatch);
            foreach ($xml->email as $xmlresponse) {
                if (!empty($xmlresponse->recipient)) {
                    $requestid = $xmlresponse->requestid;
                    $mailingid = $xmlresponse->mailingid;
                    $mailingtypeid = $xmlresponse->mailingtypeid;
                    $scheduleeventtypeid = $xmlresponse->scheduleeventtypeid;
                    $recipient = $email_hashes[ (string)$xmlresponse->recipient ];
                    $list = $xmlresponse->list;
                    $cid = $xmlresponse->cid;
                    $campaignrank = $xmlresponse->campaignrank;
                    $categoryid = $xmlresponse->categoryid;
                    $sheduledate = $xmlresponse->scheduledate;
                    $templateid = $xmlresponse->templateid;
                    $creativeid = $xmlresponse->creativeid;
                    foreach($xmlresponse->creative as $subcreative) {
                        $from = $subcreative->from;
                        $friendlyfrom = $subcreative->friendlyfrom;
                        $subjectid = $subcreative->subjectid;
                        $subject = $subcreative->subject;
                        $body = $subcreative->body;
                        $bodyconv = (string)$body;
                        $crawler = new Crawler($bodyconv);
                        $link = $crawler->filterXPath('//a/@href')->text();
                        $textbody = $subcreative->textbody;
                        $htmlcreativelength = $subcreative->htmlcreativelength;
                        $textcreativelength = $subcreative->textcreativelength;
                    }
                    #assigning template based on the category id, provided by ADK
                    #getting app details
                    $adkcategory = $adkcategoryrepo->findOneBy(['categoryid' => $categoryid]);
                        $app = $adkcategory ->getAppId();
                    #getting app name/sent from email address
                    $appdetails = $sendyappdetails->findOneBy(['id' => $app]);
                        $appname = $appdetails->getAppName();
                        $appfromemail = $appdetails->getFromEmail();

                    #creating email temaplte
                    $template = $templaterepo->findOneBy(['app' => $app]);
                    $preemail = $template->getHtmlText();
                    $template = $this->get('twig')->createTemplate($preemail);
                    $postemail = $template->render(array(
                        'link' => $link,
                        'insertone' => $friendlyfrom,
                        'sentemail' => $appfromemail,
                        'resourcename' => $appname));

                    #pushing elements to AdKnowledge table
                    $offerdetails = new SubscriberADKCampaign();
                    $query = $em ->createQuery('SELECT MAX(s.id) FROM AppBundle:SubscriberADKCampaign s');
                    $offerdetails ->setId($query->getSingleScalarResult() + 1);
                    $offerdetails ->setRequestid($requestid);
                    $offerdetails ->setMailingid($mailingid);
                    $offerdetails ->setMailingtypeid($mailingtypeid);
                    $offerdetails ->setScheduleeventtypeid($scheduleeventtypeid);
                    $offerdetails ->setRecipient($recipient);
                    $offerdetails ->setList($list);
                    $offerdetails ->setCid($cid);
                    $offerdetails ->setCampaignrank($campaignrank);
                    $offerdetails ->setCategoryid($categoryid);
                    $offerdetails ->setScheduledate($sheduledate);
                    $offerdetails ->setTemplateid($templateid);
                    $offerdetails ->setCreativeid($creativeid);
                        $offerdetails ->setFromField($from);
                        $offerdetails ->setFriendlyfrom($friendlyfrom);
                        $offerdetails ->setSubjectid($subjectid);
                        $offerdetails ->setSubject($subject);
                        $offerdetails ->setBody(trim($body,"\r"));
                        $offerdetails ->setClickurl($link);
                        $offerdetails ->setTextbody($textbody);
                        $offerdetails ->setFinalemail($postemail);
                        $offerdetails ->setHtmlcreativelength($htmlcreativelength);
                        $offerdetails ->setTextcreativelength($textcreativelength);
                    $offerdetails ->setDatecreated(new DateTime());
                    $offerdetails ->setBatchnum($curbatch);

                    $em->persist($offerdetails);
                    $em->flush();
                }
            }
            foreach ($xml->error as $xmlerror) {
                if(isset($xmlerror ->recipient)) {
                    $errornum = $xmlerror->num;
                    $errordesc = $xmlerror->str;
                    $requestid = $xmlerror->requestid;
                    $errorrecipient = $email_hashes[ (string)$xmlerror->recipient ];

                    $errordetails = new SubscriberADKCampErrors();
                    $query = $em ->createQuery('SELECT MAX(s.id) FROM AppBundle:SubscriberADKCampErrors s');
                    $errordetails ->setId($query->getSingleScalarResult() + 1);
                    $errordetails ->setErrornum($errornum);
                    $errordetails ->setErrordesc($errordesc);
                    $errordetails ->setRequestid($requestid);
                    $errordetails ->setRecipient($errorrecipient);
                    $errordetails ->setDatemodified(new DateTime());
                    $errordetails ->setBatchnum($curbatch);

                    $em->persist($errordetails);
                    $em->flush();
                }
            }
        }
        #Setting up campaign details
        #splitting data by sendy campaigns/lists/subscribers
        $adkoffers = array();
        $qb = $adkent->createQueryBuilder('s')
            ->where('s.batchnum =:curbatch')
            ->addGroupBy('s.categoryid')
            ->setParameters(array('curbatch' => $curbatch))
            ->getQuery();
        $adkoffers = $qb->getResult();

        $adkoffer = new SubscriberADKCampaign();

        if (is_array($adkoffers)) {
            foreach ($adkoffers as $adkoffer) {
                $sendyfrom = $adkoffer->getFriendlyfrom();
                $sendytitle = $adkoffer->getSubject();
                $emailbody = $adkoffer->getFinalemail();
                $categoryid = $adkoffer->getCategoryid();
                #selecting correct app id
                $adkcategory = $adkcategoryrepo->findOneBy(['categoryid' => $categoryid]);
                    $app = $adkcategory ->getAppId();
                $appdetails = $sendyappdetails->findOneBy(['id' => $app]);
                    $appfromname = $appdetails ->getFromName();
                    $appfromemail = $appdetails ->getFromEmail();
                    $appreplytoemail = $appdetails ->getReplyTo();

                    #creating subscriber lists
                    $newList = new Lists();
                    $queryli = $em ->createQuery('SELECT MAX(li.id) FROM AppBundle:Lists li');
                    $newList ->setId($queryli->getSingleScalarResult() + 1);
                    $newList ->setUserid('1');
                    $newList ->setApp($app);
                    $newList ->setName($sendyfrom);
                    $newList ->setOptIn('1');
                    $newList ->setConfirmUrl('http://mediaff.com');
                    $newList ->setThankyou('0');
                    $newList ->setGoodbye('0');
                    $newList ->setUnsubscribeAllList('1');
                    $newList ->setPrevCount('0');
                    $newList ->setCurrentlyProcessing('0');
                    $newList ->setTotalRecords('0');
                    $em->persist($newList);
                    $em->flush();

                    #creating subscriber sets
                    $qbt = $adkent->createQueryBuilder('s')
                        ->where('s.batchnum =:curbatch')
                        ->andWhere("s.categoryid = " . $adkoffer->getCategoryid())
                        ->setParameters(array('curbatch' => $curbatch))
                        ->getQuery();
                    $adkentities = $qbt->getResult();

                    $adksubscriber = new SubscriberADKCampaign();

                    foreach ($adkentities as $adksubscriber) {
                        $adksubscremail = $adksubscriber ->getRecipient();
                        $subscriber = $ent->findOneByEmailaddress($adksubscremail);
                            $firstname = $subscriber ->getFirstName();
                            $lastname = $subscriber ->getLastName();
                            $subscriptiondate = $optindetails ->getOptindate();

                        $sendySubscriber = new Subscribers();
                        $queryst = $em ->createQuery('SELECT MAX(st.id) FROM AppBundle:Subscribers st');
                        $sendySubscriber ->setId($queryst->getSingleScalarResult() + 1);
                        $sendySubscriber ->setUserid('1');
                        $sendySubscriber ->setEmailaddress($adksubscremail);
                        $sendySubscriber ->setName($firstname);
                        $sendySubscriber ->setCustomFields($lastname.'%s%');
                        $sendySubscriber ->setList($queryli->getSingleScalarResult() + 1);
                        $sendySubscriber ->setUnsubscribed('0');
                        $sendySubscriber ->setBounced('0');
                        $sendySubscriber ->setBounceSoft('0');
                        $sendySubscriber ->setComplaint('0');
                        $sendySubscriber ->setTimestamp(new DateTime());
                        $sendySubscriber ->setJoinDate($subscriptiondate);
                        $sendySubscriber ->setConfirmed('1');
                        $sendySubscriber ->setMessageID('testmessage');
                        $em->persist($sendySubscriber);
                        $em->flush();
                    }
                $sendyoffer = new Campaigns();
                $query = $em ->createQuery('SELECT MAX(s.id) FROM AppBundle:Campaigns s');
                $sendyoffer ->setId($query->getSingleScalarResult() + 1);
                $sendyoffer ->setUserid('1');
                $sendyoffer ->setApp($app);
                $sendyoffer ->setFromName($appfromname);
                $sendyoffer ->setFromEmail($appfromemail);
                $sendyoffer ->setReplyTo($appreplytoemail);
                $sendyoffer ->setTitle("[Name,fallback=], ".$sendytitle);
                $sendyoffer ->setHtmlText($emailbody);
                $sendyoffer ->setToSendLists($queryli->getSingleScalarResult() + 1);
                $sendyoffer ->setWysiwyg('1');
                $sendyoffer ->setLists($queryli->getSingleScalarResult() + 1);
                $sendyoffer ->setSendDate($depdate);
                $sendyoffer ->setTimezone($timezone);
                //$sendyoffer ->setSendDate(time() + 60);
                //$sendyoffer ->setTimezone('America/New_York');
                $em->persist($sendyoffer);
                $em->flush();
            }
        }
        $resultquery = $em ->createQuery('SELECT COUNT(DISTINCT s.recipient) FROM AppBundle:SubscriberADKCampaign s WHERE s.batchnum = '.$curbatch);
        $result = $resultquery ->getSingleScalarResult();
        return array($result);
	}
}