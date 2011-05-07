<?php


require_once 'Neo4j-REST-PHP-API/Neo4jRest.php';

use Neo4jRest\Node as Node;
use Neo4jRest\NodeIndex as NodeIndex;
use Neo4jRest\HttpHelper as HttpHelper;

class NodeIndexExt extends NodeIndex {
   
   /*
    * Provides a PHP api to the limit_by_count NodeIndex extension.
    * 
    * Using curl:
    * 
    * curl -X POST -H Accept:application/json 
    *     -H ContentType:application/json 
    *     -d 'index=names&key=name&query=*b*&count=2' 
    *     http://localhost:7474/db/data/ext/
    *     NodeIndex/graphdb/limit_by_count
    */
   function query($key, $query, $count=4) {

		$uri = $this->_neo4j_db->getBaseUri() . 
			'ext/NodeIndex/graphdb/limit_by_count';

		$data = array('index' => $this->getName(), 'key' => $key,
		   'query' => $query, 'count' => $count);
		
       list($response, $httpCode) = HttpHelper::jsonPostRequest($uri, $data);

       if ($httpCode != 200) {
           throw new Neo4jRest_HttpException(
          'Http exception with code "' . $httpCode . 
              '" trying to find index entry', $httpCode); 
       }

       $nodes = array();
       foreach ($response as $result) {
           $node = Node::inflateFromResponse($this->_neo4j_db,
               $result);
           $nodes[] = $node;
       }

       return $nodes;
       
   }
      
}