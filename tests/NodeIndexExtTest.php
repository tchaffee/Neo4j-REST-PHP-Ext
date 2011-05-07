<?php

require_once 'Neo4jRestExt/NodeIndexExt.php';
require_once 'PHPUnit/Framework.php';

use Neo4jRest\GraphDataBaseService as GraphDataBaseService;
use Neo4jRest\GraphDataBaseService as GraphDataBaseService;

/**
 * Test class for NodeIndexExt.
 * 
 */
class NodeIndexTestExt extends PHPUnit_Framework_TestCase
{
    /**
     * @var NodeIndex
     */
    protected $index;
    protected $indexMgr;
    protected $indexName;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->graphDbUri = 'http://localhost:7474/db/data/';
        $this->graphDb = new GraphDatabaseService($this->graphDbUri);
               
        $this->indexName = 'names';
        $this->index = new NodeIndexExt($this->indexName, $this->graphDb); 
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }


    /**
     * 
     */
    public function testQuery()
    {
        // Basic test case.
        $key = 'name';
        $value = '*chaff*';
        $count = 4;
        
        $nodes = $this->index->query($key, $value, $count);

        $this->assertEquals('', print_r($nodes, true));        
        
    }
}    

?>
