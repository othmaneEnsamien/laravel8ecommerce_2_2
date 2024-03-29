<?php

namespace App\Http\Livewire\User;

use App\Models\OrderItems;
use App\Models\Review;
use Livewire\Component;

class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;

    public function mount($order_item_id)
    {
        $this->order_iten_id = $order_item_id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'rating' => 'required',
            'comment' => 'required'
        ]);
    }

    public function addReview()
    {
        $this->validate([
            'rating' => 'required',
            'comment' => 'required'
        ]);

        $review = new Review();
        $review->rating = $this->rating;
        $review->comment = $this->comment;
        $review->order_item_id = $this->order_item_id;
        $review->save();
        $orderItem = OrderItems::find($this->order_item_id);
        $orderItem->revstatus = true;
        $orderItem->save();
        session()->flash('message', 'review has been added successfully');
    }





    public function render()
    {
        $orderItem = OrderItems::find($this->order_item_id);
        return view('livewire.user.user-review-component', compact('orderItem'))->layout('layouts.base');
    }
}
