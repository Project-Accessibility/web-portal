<?php

use App\Utils\TableLink;
use App\Utils\TableLinkParameter;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class TableLinkTest extends Testcase
{
    /** @test */
    public function it_can_set_the_parameters_to_the_object()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            routeValue: '321',
        );
        $tableLinkParameter_two = new TableLinkParameter(
            routeParameter: 'fake_param_two',
            routeValue: '654',
        );
        $tableLinkParameters = collect([
            $tableLinkParameter_one,
            $tableLinkParameter_two,
        ]);

        $tableLink = new TableLink(
            'fake.route.with.two.params',
            $tableLinkParameters,
        );

        $this->assertTrue($tableLink->route === 'fake.route.with.two.params');
        $this->assertTrue(
            $tableLink->parameters->toArray() === [
                $tableLinkParameter_one,
                $tableLinkParameter_two,
            ],
        );
    }

    /** @test */
    public function it_can_create_a_url_without_keys()
    {
        $tableLink = new TableLink('fake.route.without.params');

        $url = $tableLink->createUrl();

        $this->assertTrue($url === URL::current() . '/fake-route');
    }

    /** @test */
    public function it_can_create_a_url_with_one_set_key()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            routeValue: '321',
        );
        $tableLinkParameters = collect([$tableLinkParameter_one]);

        $tableLink = new TableLink(
            'fake.route.with.one.param',
            $tableLinkParameters,
        );

        $url = $tableLink->createUrl();

        $this->assertTrue($url === URL::current() . '/fake-route/321');
    }

    /** @test */
    public function it_can_create_a_url_with_one_not_set_key()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            itemIndex: 'item_id',
        );
        $tableLinkParameters = collect([$tableLinkParameter_one]);

        $tableLink = new TableLink(
            'fake.route.with.one.param',
            $tableLinkParameters,
        );

        $url = $tableLink->createUrl([
            'item_id' => '987',
            'item_other_variable' => 'other_var',
        ]);

        $this->assertTrue($url === URL::current() . '/fake-route/987');
    }

    /** @test */
    public function it_can_create_a_url_with_two_set_keys()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            routeValue: '321',
        );
        $tableLinkParameter_two = new TableLinkParameter(
            routeParameter: 'fake_param_two',
            routeValue: '654',
        );
        $tableLinkParameters = collect([
            $tableLinkParameter_one,
            $tableLinkParameter_two,
        ]);

        $tableLink = new TableLink(
            'fake.route.with.two.params',
            $tableLinkParameters,
        );

        $url = $tableLink->createUrl();

        $this->assertTrue(
            $url === URL::current() . '/fake-route/321/more-fake/654',
        );
    }

    /** @test */
    public function it_can_create_a_url_with_two_not_set_keys()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            itemIndex: 'item_id_one',
        );
        $tableLinkParameter_two = new TableLinkParameter(
            routeParameter: 'fake_param_two',
            itemIndex: 'item_id_two',
        );
        $tableLinkParameters = collect([
            $tableLinkParameter_one,
            $tableLinkParameter_two,
        ]);

        $tableLink = new TableLink(
            'fake.route.with.two.params',
            $tableLinkParameters,
        );

        $url = $tableLink->createUrl([
            'item_id_one' => 'cba',
            'item_other_variable' => 'other_var',
            'item_id_two' => 'fed',
        ]);

        $this->assertTrue(
            $url === URL::current() . '/fake-route/cba/more-fake/fed',
        );
    }

    /** @test */
    public function it_can_create_a_url_with_one_set_key_and_one_not_set_key()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            routeValue: 'zyx',
        );
        $tableLinkParameter_two = new TableLinkParameter(
            routeParameter: 'fake_param_two',
            itemIndex: 'item_id_two',
        );
        $tableLinkParameters = collect([
            $tableLinkParameter_one,
            $tableLinkParameter_two,
        ]);

        $tableLink = new TableLink(
            'fake.route.with.two.params',
            $tableLinkParameters,
        );

        $url = $tableLink->createUrl([
            'item_id_one' => 'cba',
            'item_other_variable' => 'other_var',
            'item_id_two' => 'fed',
        ]);

        $this->assertTrue(
            $url === URL::current() . '/fake-route/zyx/more-fake/fed',
        );
    }

    /** @test */
    public function it_gets_the_name_with_link()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            routeValue: 'zyx',
        );

        $tableLinkParameters = collect([$tableLinkParameter_one]);

        $tableLink = new TableLink(
            'fake.route.with.one.param',
            $tableLinkParameters,
        );

        $urlWithName = $tableLink->getUrlWithName();
        $this->assertTrue(
            $urlWithName === [
                'fake.route.with.one.param' =>
                    URL::current() . '/fake-route/zyx',
            ],
        );
    }

    /** @test */
    public function it_gets_the_display_with_link()
    {
        $tableLinkParameter_one = new TableLinkParameter(
            routeParameter: 'fake_param_one',
            routeValue: 'zyx',
        );
        $tableLinkParameter_two = new TableLinkParameter(
            routeParameter: 'fake_param_two',
            routeValue: 'fed',
        );
        $tableLinkParameters = collect([
            $tableLinkParameter_one,
            $tableLinkParameter_two,
        ]);

        $tableLink = new TableLink(
            'fake.route.with.two.params',
            $tableLinkParameters,
        );

        $urlWithName = $tableLink->getUrlWithName();
        $this->assertTrue(
            $urlWithName === [
                'test view name' =>
                    URL::current() . '/fake-route/zyx/more-fake/fed',
            ],
        );
    }
}
