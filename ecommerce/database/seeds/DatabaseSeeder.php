<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Comment;
use App\Product;
use App\PurchaseOrder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $products = factory(Product::class)->times(4)->create();
        $comments = factory(Comment::class)->times(4)->create();
        $purchaseOrders = factory(PurchaseOrder::class)->times(4)->create();

        $users = User::all();

        foreach($products as $product) {
            $product->category()->associate(Category::all()->random(1)->first())->save();
            $product->usersWhoHaveSeenIt()->saveMany($users->random(2));
        }

        foreach($purchaseOrders as $purchaseOrder) {
            $purchaseOrder->user()->associate($users->random(1)->first())->save();
            $purchaseOrder->products()->saveMany($products->random(2));

            foreach($purchaseOrder->products as $product) {
                $purchaseOrder->products()->updateExistingPivot($product->id,array('quantity' => rand(1,5)));
            }
        }

        foreach($comments as $comment) {
            $comment->product()->associate($products->random(1)->first())->save();
            $comment->user()->associate($users->random(1)->first())->save();
        }
    }
}
