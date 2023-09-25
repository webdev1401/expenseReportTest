<?php

use App\Entity\Fee;
use App\Factory\FeeFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class FeesTest extends ApiTestCase
{
    use ResetDatabase, Factories;
    
    public function testGetFees(): void
    {
        FeeFactory::createMany(50);

        $response = static::createClient()->request('GET', '/api/fees');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertCount(30, $response->toArray()['hydra:member']);
        
        $this->assertJsonContains([
            '@context' => '/api/contexts/Fee',
            '@id' => '/api/fees',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 50,
            'hydra:view' => [
                '@id' => '/api/fees?page=1',
                '@type' => 'hydra:PartialCollectionView',
                'hydra:first' => '/api/fees?page=1',
                'hydra:last' => '/api/fees?page=2',
                'hydra:next' => '/api/fees?page=2',
            ],
        ]);

        $this->assertMatchesResourceCollectionJsonSchema(Fee::class);
    }

    public function testAddFee()
    {
        $data = [
            'date' => '2023-09-25T00:00:00+00:00',
                    'amount' => '35.5',
                    'type' => 'péage',
                    'company' => 'VINCI'
        ];

        $response = static::createClient()->request(
            'POST',
            '/api/fees',
            [
                'json' => $data
            ]
        );

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertJsonContains([
            '@context' => '/api/contexts/Fee',
            '@type' => 'Fee',
            'date' => $data['date'],
            'amount' => $data['amount'],
            'type' => $data['type'],
            'company' => $data['company'],
        ]);

        $this->assertMatchesRegularExpression('~^/api/fees/\d+$~', $response->toArray()['@id']);
        $this->assertMatchesResourceItemJsonSchema(Fee::class);
    }

    public function testUpdateFee(): void
    {
        $fee = FeeFactory::createOne(['type' => 'repas']);
        $response = static::createClient();
        // findIriBy allows to retrieve the IRI of an item by searching for some of its properties.
        $iri = $this->findIriBy(Fee::class, ['id' => $fee->getId()]);

        $this->assertEquals('repas', $fee->getType()); // we test the data before the call to the API

        $response->request(
            'PATCH',
            $iri,
            [
                'json' => [
                    'type' => 'conférence',
                ],
                'headers' => [
                    'Content-Type' => 'application/merge-patch+json',
                ]
            ]
        );

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@id' => $iri,
            'type' => 'conférence',
        ]);

        $this->assertEquals('conférence', $fee->getType()); // we ensure that the data has been updated
    }

    public function testDeleteFee()
    {
        // Only create the book we need with a given ISBN
        FeeFactory::createOne(['type' => 'essence']);
        
        $response = static::createClient();
        $iri = $this->findIriBy(Fee::class, ['type' => 'essence']);
        $response->request('DELETE', $iri);
        $this->assertResponseStatusCodeSame(204);
        $this->assertNull(
            static::getContainer()->get('doctrine')->getRepository(Fee::class)->findOneBy(['type' => 'essence'])
        );
    }

}