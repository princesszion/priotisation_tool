<?php
//Delete Index
use Elastic\Elasticsearch\ClientBuilder;
class Elasticjobs extends MX_Controller
{
public function esClient(){
    // Set up Elasticsearch client with disabled SSL verification
    $esClient = ClientBuilder::create()
    ->setHosts([$_ENV['ES_HOST']])
    ->setSSLVerification(false)
    ->setBasicAuthentication($_ENV['ES_USERNAME'], $_ENV['ES_PASSWORD'])
    ->build();
    
    return $esClient;
}
function deleteIndex($indexName)
{
    $esClient = $this->esClient();
    try {
        $exists = $esClient->indices()->exists(['index' => $indexName]);

        if ($exists->asBool()) {
            $esClient->indices()->delete(['index' => $indexName]);
            echo "Index '$indexName' deleted successfully.\n";
        } else {
            echo "Index '$indexName' does not exist.\n";
        }
    } catch (Exception $e) {
        echo 'Error deleting index: ' . $e->getMessage() . "\n";
    }
}

// Function to create the index with proper mapping
function createIndex($indexName,$params)
{
    $esClient = $this->esClient();
    $params = [
        'index' => $indexName,
        'body' => [
            'mappings' => [
                'properties' => [
                    'category' => ['type' => 'keyword'],
                    'description' => ['type' => 'keyword'],
                    'countries' => ['type' => 'keyword'],
                   
                  


            
                ],
            ],
        ],
    ];

    try {
        $esClient->indices()->create($params);
        echo "Index '$indexName' created successfully with proper mappings.\n";
    } catch (Exception $e) {
        echo 'Error creating index: ' . $e->getMessage() . "\n";
    }
}

// Function to load data from MySQL to Elasticsearch
function elastic_countries_categories($indexName)
{
    $esClient = $this->esClient();
    $query = $this->db->query("SELECT * FROM countries_categories")->result();  // Query your view

    if ($query === false) {
        die('MySQL query error: ' . $mysqli->error);
    }

    while ($row = $result->fetch_assoc()) {
        try {
            // Index data into Elasticsearch
            $esClient->index([
                'index' => $indexName,
                'body' => [
                    'category' => $row['no'],
                    'description' => $row['description'],
                    'countries' => $row['countries'],
                
                ]
            ]);

            echo "Data indexed successfully\n";
        } catch (Exception $e) {
            echo 'Error indexing data: ' . $e->getMessage() . "\n";
        }
    }
}
}