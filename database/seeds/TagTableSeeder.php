<?php

use Illuminate\Database\Seeder;

use App\Tag;

use App\Post;


class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('tags')->turncate();
        $aviation=new Tag();
        $aviation->name="Aviation";
        $aviation->slug="aviation";
        $aviation->save();

        $Logistics=new Tag();
        $Logistics->name="Logistics";
        $Logistics->slug="logistics";
        $Logistics->save();

        $Shipping=new Tag();
        $Shipping->name="Shipping";
        $Shipping->slug="shipping";
        $Shipping->save();

        $RailwaysTransport=new Tag();
        $RailwaysTransport->name="Railways & Transport";
        $RailwaysTransport->slug="railways-and-transport";
        $RailwaysTransport->save();

        $TradeECommerce=new Tag();
        $TradeECommerce->name="Trade & E-Commerce";
        $TradeECommerce->slug="trade-and-e-Commerce";
        $TradeECommerce->save();

    }
}
