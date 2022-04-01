<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit New Category
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.categories') }}" class="btn btn-success pull-right">All Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))                       
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>                   
                        @endif
                        <form wire:submit.prevent="updatecategory" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-4 control-label">Category Name</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Category Name"  class="form-control inpu-md" wire:model="name" wire:keyup="generateslug">
                                    @error('name') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Category Slug</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Category Slug"  class="form-control inpu-md" wire:model="slug">
                                    @error('slug') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Parent Slug</div>
                                <div class="col-md-4">
                                   <select class="form-control" wire:model="category_id" >
                                       <option value="">None</option>
                                       @foreach($categories as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                       @endforeach
                                   </select>
                                    @error('slug') <p class="text-danger">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>