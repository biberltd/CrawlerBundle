<?php
/**
 * @vendor      BiberLtd
 * @package		Core\Bundles\CrawlerBundle
 * @subpackage	Services
 * @name	    CrawlerModel
 *
 * @author		Can Berkol
 * @author		Said İmamoğlu
 *
 * @copyright   Biber Ltd. (www.biberltd.com)
 *
 * @version     1.0.1
 * @date        09.06.2015
 */
namespace BiberLtd\Bundle\CrawlerBundle\Services;
/** Extends CoreModel */
use BiberLtd\Bundle\CoreBundle\CoreModel;

/** Entities to be used */
use BiberLtd\Bundle\CrawlerBundle\Entity as BundleEntity;

/** Core Service*/
use BiberLtd\Bundle\CoreBundle\Services as CoreServices;
use BiberLtd\Bundle\CoreBundle\Exceptions as CoreExceptions;

class CrawlerModel extends CoreModel {
    /**
     * @name            __construct()
     *                  Constructor.
     *
     * @author          Said İmamoğlu
     *
     * @since           1.0.0
     * @version         1.0.0
     *
     * @param           object          $kernel
     * @param           string          $db_connection  Database connection key as set in app/config.yml
     * @param           string          $orm            ORM that is used.
     */
    public function __construct($kernel, $db_connection = 'default', $orm = 'doctrine'){
        parent::__construct($kernel, $db_connection, $orm);

        $this->entity = array(
            'cli'		=> array('name' => 'CrawlerBundle:CrawlerLink', 'alias' => 'cli'),
            'clo' 	=> array('name' => 'CrawlerBundle:CrawlerLog', 'alias' => 'clo'),
        );
    }
    /**
     * @name            __destruct()
     *
     * @author          Said İmamoğlu
     *
     * @since           1.0.0
     * @version         1.0.0
     *
     */
    public function __destruct(){
        foreach($this as $property => $value) {
            $this->$property = null;
        }
    }
    /**
     * @name 			deleteCrawlerLink()
     *
     * @since			1.0.0
     * @version         1.0.0
     *
     * @author          Said İmamoğlu
     *
     * @use             $this->deleteCrawlerLinks()
     *
     * @param           mixed           $crawlerLink
     *
     * @return          BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function deleteCrawlerLink($crawlerLink){
        return $this->deleteCrawlerLinks(array($crawlerLink));
    }
    /**
     * @name 			deleteCrawlerLinks()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $collection
     *
     * @return          BiberLtd\Bundle\CoreBundle\Responses\ModelResponse
     */
    public function deleteCrawlerLinks($collection) {
        $timeStamp = time();
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countDeleted = 0;
        foreach($collection as $entry){
            if($entry instanceof BundleEntity\CrawlerLink){
                $this->em->remove($entry);
                $countDeleted++;
            }
            else{
                $response = $this->getCrawlerLink($entry);
                if(!$response->error->exists){
                    $entry = $response->result->set;
                    $this->em->remove($entry);
                    $countDeleted++;
                }
            }
        }
        if($countDeleted < 0){
            return new ModelResponse(null, 0, 0, null, true, 'E:E:001', 'Unable to delete all or some of the selected entries.', $timeStamp, time());
        }
        $this->em->flush();

        return new ModelResponse(null, 0, 0, null, false, 'S:D:001', 'Selected entries have been successfully removed from database.', $timeStamp, time());
    }
    /**
     * @name 			deleteCrawlerLog()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->deleteCrawlerLogs()
     *
     * @param           mixed           $crawlerLog
     *
     * @return          mixed           $response
     */
    public function deleteCrawlerLog($crawlerLog){
        return $this->deleteCrawlerLogs(array($crawlerLog));
    }
    /**
     * @name 			deleteCrawlerLogs()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $collection
     *
     * @return          array           $response
     */
    public function deleteCrawlerLogs($collection){
        $timeStamp = time();
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countDeleted = 0;
        foreach($collection as $entry){
            if($entry instanceof BundleEntity\CrawlerLog){
                $this->em->remove($entry);
                $countDeleted++;
            }
            else{
                $response = $this->getCrawlerLog($entry);
                if(!$response->error->exists){
                    $entry = $response->result->set;
                    $this->em->remove($entry);
                    $countDeleted++;
                }
            }
        }
        if($countDeleted < 0){
            return new ModelResponse(null, 0, 0, null, true, 'E:E:001', 'Unable to delete all or some of the selected entries.', $timeStamp, time());
        }
        $this->em->flush();

        return new ModelResponse(null, 0, 0, null, false, 'S:D:001', 'Selected entries have been successfully removed from database.', $timeStamp, time());
    }
    /**
     * @name 			doesCrawlerLinkExist()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->getCrawlerLink()
     *
     * @param           mixed           $crawlerLink         id, code
     * @param           bool            $bypass         If set to true does not return response but only the result.
     *
     * @return          mixed           $response
     */
    public function doesCrawlerLinkExist($crawlerLink, $bypass = false) {
        $timeStamp = time();
        $exist = false;

        $response = $this->getCrawlerLink($crawlerLink);

        if ($response->error->exists) {
            if($bypass){
                return $exist;
            }
            $response->result->set = false;
            return $response;
        }

        $exist = true;

        if ($bypass) {
            return $exist;
        }
        return new ModelResponse(true, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
    }
    /**
     * @name 			doesCrawlerLogExist()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->getCrawlerLink()
     *
     * @param           mixed           $crawlerLog
     * @param           bool            $bypass
     *
     * @return          mixed           $response
     */
    public function doesCrawlerLogExist($crawlerLog, $bypass = false) {
        $timeStamp = time();
        $exist = false;

        $response = $this->getCrawlerLog($crawlerLog);

        if ($response->error->exists) {
            if ($bypass) {
                return $exist;
            }
            $response->result->set = false;

            return $response;
        }

        $exist = true;

        if ($bypass) {
            return $exist;
        }

        return new ModelResponse(true, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
    }
    /**
     * @name 			getCrawlerLink()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           mixed           $crawlerLink
     *
     * @return          mixed           $response
     */
    public function getCrawlerLink($crawlerLink) {
        $timeStamp = time();
        if($crawlerLink instanceof BundleEntity\CrawlerLink){
            return new ModelResponse($crawlerLink, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
        }
        $result = null;
        switch($crawlerLink){
            case is_numeric($crawlerLink):
                $result = $this->em->getRepository($this->entity['cli']['name'])->findOneBy(array('id' => $crawlerLink));
                break;
        }
        if(is_null($result)){
            return new ModelResponse($result, 0, 0, null, true, 'E:D:002', 'Unable to find request entry in database.', $timeStamp, time());
        }

        return new ModelResponse($result, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
    }
    /**
     * @name 			getCrawlerLog()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           mixed           $crawlerLog
     *
     * @return          mixed           $response
     */
    public function getCrawlerLog($crawlerLog) {
        $timeStamp = time();
        if($crawlerLog instanceof BundleEntity\CrawlerLog){
            return new ModelResponse($crawlerLog, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
        }
        $result = null;
        switch($crawlerLog){
            case is_numeric($crawlerLog):
                $result = $this->em->getRepository($this->entity['clo']['name'])->findOneBy(array('id' => $crawlerLog));
                break;
        }
        if(is_null($result)){
            return new ModelResponse($result, 0, 0, null, true, 'E:D:002', 'Unable to find request entry in database.', $timeStamp, time());
        }

        return new ModelResponse($result, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
    }
	/**
	 * @name 			getLastCrawlerLog()
	 *
	 * @since			1.0.1
	 * @version         1.0.1
	 * @author          Can Berkol
	 *
	 * @use             $this->createException()
	 *
	 * @param           array			$filter
	 *
	 * @return          mixed           $response
	 */
	public function getLastCrawlerLog($filter = null) {
		$timeStamp = time();
		$response = $this->listCrawlerLinks($filter, array('timestamp' => 'desc'), array('start' => 0, 'count' => 1));

		if($response->error->exist){
			return $response;
		}

		return new ModelResponse($response->result->set, 1, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
	}
    /**
     * @name 			insertCrawlerLink()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->insertCrawlerLinks()
     *
     * @param           mixed           $crawlerLink               Entity or post
     *
     * @return          array           $response
     */
    public function insertCrawlerLink($crawlerLink){
        return $this->insertCrawlerLinks(array($crawlerLink));
    }
    /**
     * @name 			insertCrawlerLinks()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $collection
     *
     * @return          array           $response
     */
    public function insertCrawlerLinks($collection)	{
        $timeStamp = time();
        /** Parameter must be an array */
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countInserts = 0;
        $insertedItems = array();
        foreach ($collection as $data) {
            if ($data instanceof BundleEntity\CrawlerLink) {
                $entity = $data;
                $this->em->persist($entity);
                $insertedItems[] = $entity;
                $countInserts++;
            }
            else if (is_object($data)) {
                $entity = new BundleEntity\CrawlerLink;
                if (!property_exists($data, 'date_added')) {
                    $data->date_added = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));
                }
                if (!property_exists($data, 'date_updated')) {
                    $data->date_updated = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));
                }
                if (!property_exists($data, 'count_logs')) {
                    $data->count_logs = 0;
                }
                foreach ($data as $column => $value) {
                    $set = 'set' . $this->translateColumnName($column);
                    switch ($column) {
                        default:
                            $entity->$set($value);
                            break;
                    }
                }
                $this->em->persist($entity);
                $insertedItems[] = $entity;

                $countInserts++;
            }
        }
        if ($countInserts > 0) {
            $this->em->flush();
        }
        if($countInserts > 0){
            $this->em->flush();
            return new ModelResponse($insertedItems, $countInserts, 0, null, false, 'S:D:003', 'Selected entries have been successfully inserted into database.', $timeStamp, time());
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:003', 'One or more entities cannot be inserted into database.', $timeStamp, time());
    }
    /**
     * @name 			insertCrawlerLog()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->insertCrawlerLogs()
     *
     * @param           mixed           $crawlerLog               Entity or post
     *
     * @return          array           $response
     */
    public function insertCrawlerLog($crawlerLog){
        return $this->insertCrawlerLogs(array($crawlerLog));
    }
    /**
     * @name 			insertCrawlerLogs()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $collection
     *
     * @return          array           $response
     */
    public function insertCrawlerLogs($collection) {
        $timeStamp = time();
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countInserts = 0;
        $insertedItems = array();
        foreach($collection as $data){
            if($data instanceof BundleEntity\CrawlerLog){
                $entity = $data;
                $this->em->persist($entity);
                $insertedItems[] = $entity;
                $countInserts++;
            }
            else if(is_object($data)){
                $entity = new BundleEntity\CrawlerLog();
                foreach($data as $column => $value){
                    $set = 'set'.$this->translateColumnName($column);
                    switch($column){
                        default:
                            $entity->$set($value);
                            break;
                    }
                }
                $this->em->persist($entity);
                $insertedItems[] = $entity;
                $countInserts++;
            }
        }
        if($countInserts > 0){
            $this->em->flush();
            return new ModelResponse($insertedItems, $countInserts, 0, null, false, 'S:D:003', 'Selected entries have been successfully inserted into database.', $timeStamp, time());
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:003', 'One or more entities cannot be inserted into database.', $timeStamp, time());
    }
    /**
     * @name 			listCrawlerLinks()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $filter
     * @param           array           $sortOrder
     * @param           array           $limit
     *
     * @return          array           $response
     */
    public function listCrawlerLinks($filter = null, $sortOrder = null, $limit = null){
        $timeStamp = time();
        if(!is_array($sortOrder) && !is_null($sortOrder)){
            return $this->createException('InvalidSortOrderException', '$sortOrder must be an array with key => value pairs where value can only be "asc" or "desc".', 'E:S:002');
        }
        $oStr = $wStr = $gStr = $fStr = '';

        $qStr = 'SELECT '.$this->entity['al']['alias'].', '.$this->entity['cli']['alias']
            .' FROM '.$this->entity['al']['name'].' '.$this->entity['al']['alias'];

        if(!is_null($sortOrder)){
            foreach($sortOrder as $column => $direction){
                switch($column){
                    case 'id':
                    case 'url':
                    case 'section':
                    case 'priority':
                        $column = $this->entity['cli']['alias'].'.'.$column;
                        break;
                }
                $oStr .= ' '.$column.' '.strtoupper($direction).', ';
            }
            $oStr = rtrim($oStr, ', ');
            $oStr = ' ORDER BY '.$oStr.' ';
        }

        if(!is_null($filter)){
            $fStr = $this->prepareWhere($filter);
            $wStr .= ' WHERE '.$fStr;
        }

        $qStr .= $wStr.$gStr.$oStr;
        $q = $this->em->createQuery($qStr);
        $q = $this->addLimit($q, $limit);

        $result = $q->getResult();

        $entities = array();
        foreach($result as $entry){
            $id = $entry->getCrawlerLink()->getId();
            if(!isset($unique[$id])){
                $entities[] = $entry->getCrawlerLink();
            }
        }
        $totalRows = count($entities);
        if ($totalRows < 1) {
            return new ModelResponse(null, 0, 0, null, true, 'E:D:002', 'No entries found in database that matches to your criterion.', $timeStamp, time());
        }
        return new ModelResponse($entities, $totalRows, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
    }
    /**
     * @name 			listCrawlerLogs()
     *  				List crawlerLogs from database based on a variety of conditions.
     *
     * @since			1.0.0
     * @version         1.0.4
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $filter
     * @param           array           $sortOrder
     * @param           array           $limit
     *
     * @return          array           $response
     */
    public function listCrawlerLogs($filter = null, $sortOrder = null, $limit = null, $query_str = null){
        $timeStamp = time();
        if(!is_array($sortOrder) && !is_null($sortOrder)){
            return $this->createException('InvalidSortOrderException', '$sortOrder must be an array with key => value pairs where value can only be "asc" or "desc".', 'E:S:002');
        }
        $oStr = $wStr = $gStr = $fStr = '';
        $where_str = '';
        $group_str = '';

        $qStr = 'SELECT '.$this->entity['clo']['alias']
            .' FROM '.$this->entity['clo']['name'].' '.$this->entity['clo']['alias'];

        if($sortOrder != null){
            foreach($sortOrder as $column => $direction){
                switch($column){
                    case 'id':
                        $column = $this->entity['clo']['alias'].'.'.$column;
                        break;
                }
                $oStr .= ' '.$column.' '.strtoupper($direction).', ';
            }
            $oStr = rtrim($oStr, ', ');
            $oStr = ' ORDER BY '.$oStr.' ';
        }

        if($filter != null){
            $fStr = $this->prepareWhere($filter);
            $wStr .= ' WHERE '.$fStr;
        }
        $qStr .= $wStr.$gStr.$oStr;
        $q = $this->em->createQuery($qStr);
        $q = $this->addLimit($q, $limit);

        $result = $q->getResult();

        $totalRows = count($result);
        if ($totalRows < 1) {
            return new ModelResponse(null, 0, 0, null, true, 'E:D:002', 'No entries found in database that matches to your criterion.', $timeStamp, time());
        }
        return new ModelResponse($result, $totalRows, 0, null, false, 'S:D:002', 'Entries successfully fetched from database.', $timeStamp, time());
    }
    /**
     * @name 			updateCrawlerLink()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->updateCrawlerLinks()
     *
     * @param           mixed           $crawlerLink
     *
     * @return          mixed           $response
     */
    public function updateCrawlerLink($crawlerLink){
        return $this->updateCrawlerLinks(array($crawlerLink));
    }
    /**
     * @name 			updateCrawlerLinks()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $collection
     *
     * @return          array           $response
     */
    public function updateCrawlerLinks($collection){
        $timeStamp = time();
        /** Parameter must be an array */
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countUpdates = 0;
        $updatedItems = array();
        foreach ($collection as $data) {
            if ($data instanceof BundleEntity\CrawlerLink) {
                $entity = $data;
                $this->em->persist($entity);
                $updatedItems[] = $entity;
                $countUpdates++;
            }
            else if (is_object($data)) {
                if (!property_exists($data, 'id') || !is_numeric($data->id)) {
                    return $this->createException('InvalidParameterException', 'Parameter must be an object with the "id" parameter and id parameter must have an integer value.', 'E:S:003');
                }
                if (!property_exists($data, 'date_updated')) {
                    $data->date_updated = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));
                }
                if (property_exists($data, 'date_added')) {
                    unset($data->date_added);
                }
                if (!property_exists($data, 'site')) {
                    $data->site = 1;
                }
                $response = $this->getCrawlerLink($data->id);
                if ($response->error->exist) {
                    return $this->createException('EntityDoesNotExist', 'CrawlerLink with id '.$data->id.' does not exist in database.', 'E:D:002');
                }
                $oldEntity = $response->result->set;
                foreach ($data as $column => $value) {
                    $set = 'set' . $this->translateColumnName($column);
                    switch ($column) {
                        case 'id':
                            break;
                        default:
                            $oldEntity->$set($value);
                            break;
                    }
                    if ($oldEntity->isModified()) {
                        $this->em->persist($oldEntity);
                        $countUpdates++;
                        $updatedItems[] = $oldEntity;
                    }
                }
            }
        }
        if($countUpdates > 0){
            $this->em->flush();
            return new ModelResponse($updatedItems, $countUpdates, 0, null, false, 'S:D:004', 'Selected entries have been successfully updated within database.', $timeStamp, time());
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:004', 'One or more entities cannot be updated within database.', $timeStamp, time());
    }
    /**
     * @name 			updateCrawlerLog(
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->updateCrawlerLogs()
     *
     * @param           mixed           $crawlerLog
     *
     * @return          mixed           $response
     */
    public function updateCrawlerLog($crawlerLog){
        return $this->updateCrawlerLogs(array($crawlerLog));
    }
    /**
     * @name 			updateCrawlerLogs()
     *
     * @since			1.0.0
     * @version         1.0.0
     * @author          Said İmamoğlu
     *
     * @use             $this->createException()
     *
     * @param           array           $collection
     *
     * @return          array           $response
     */
    public function updateCrawlerLogs($collection){
        $timeStamp = time();
        /** Parameter must be an array */
        if (!is_array($collection)) {
            return $this->createException('InvalidParameterValueException', 'Invalid parameter value. Parameter must be an array collection', 'E:S:001');
        }
        $countUpdates = 0;
        $updatedItems = array();
        foreach($collection as $data){
            if($data instanceof BundleEntity\CrawlerLog){
                $entity = $data;
                $this->em->persist($entity);
                $updatedItems[] = $entity;
                $countUpdates++;
            }
            else if(is_object($data)){
                if(!property_exists($data, 'id') || !is_numeric($data->id)){
                    return $this->createException('InvalidParameterException', 'Parameter must be an object with the "id" parameter and id parameter must have an integer value.', 'E:S:003');
                }
                if(!property_exists($data, 'date_access')){
                    $data->date_access = new \DateTime('now', new \DateTimeZone($this->kernel->getContainer()->getParameter('app_timezone')));
                }
                $response = $this->getCrawlerLog($data->id);
                if($response->error->exist){
                    return $this->createException('EntityDoesNotExist', 'CrawlerLog with id '.$data->id.' does not exist in database.', 'E:D:002');
                }
                $oldEntity = $response->result->set;
                foreach($data as $column => $value){
                    $set = 'set'.$this->translateColumnName($column);
                    switch($column){
                        case 'id':
                            break;
                        default:
                            $oldEntity->$set($value);
                            break;
                    }
                    if($oldEntity->isModified()){
                        $this->em->persist($oldEntity);
                        $countUpdates++;
                        $updatedItems[] = $oldEntity;
                    }
                }
            }
        }
        if($countUpdates > 0){
            $this->em->flush();
            return new ModelResponse($updatedItems, $countUpdates, 0, null, false, 'S:D:004', 'Selected entries have been successfully updated within database.', $timeStamp, time());
        }
        return new ModelResponse(null, 0, 0, null, true, 'E:D:004', 'One or more entities cannot be updated within database.', $timeStamp, time());
    }
}

/**
 * Change Log
 * **************************************
 * v1.0.1                      09.06.2015
 * Can Berkol
 * **************************************
 * FR :: getLastCrwlerLog() method implemented.
 *
 * **************************************
 * v1.0.0                      Said İmamoğlu
 * 05.05.2015
 * **************************************
 * A __construct()
 * A __destruct()
 * A deleteCrawlerLink()
 * A deleteCrawlerLinks()
 * A deleteCrawlerLog()
 * A deleteCrawlerLogs()
 * A doesCrawlerLinkExist()
 * A doesCrawlerLogExist()
 * A getCrawlerLink()
 * A getCrawlerLog()
 * A insertCrawlerLink()
 * A insertCrawlerLinks()
 * A insertCrawlerLog()
 * A insertCrawlerLogs()
 * A listCrawlerLinks()
 * A listCrawlerLogs()
 * A updateCrawlerLink()
 * A updateCrawlerLinks()
 * A updateCrawlerLog()
 * A updateCrawlerLogs()
 */

