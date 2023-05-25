<?php

namespace App\Tests\Functional\Post;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostTest extends WebTestCase
{
    public function testBlogPageWorks(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Symblog');
    }

    public function testBlogPagePaginationWorks(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Symblog');
        $posts = $crawler->filter('div.card');
        $this->assertCount(5,$posts);

        $link = $crawler->selectLink('1')->extract(['href'])[0];
        $crawler = $client->request('GET',$link );
        $this->assertResponseIsSuccessful();

        $posts = $crawler->filter('div.card');
        $this->assertGreaterThan(1,count($posts));
    }
}
