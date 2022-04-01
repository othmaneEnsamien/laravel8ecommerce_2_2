<div>
   <div class="container" style="padding:30px 0px">
       <div class="row">
           <div class="col-md-12">
               <div class="panel panel-default">
                   <div class="panel-heading">
                    Settings
                   </div>
                   <div class="panel-body">
                       @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                       @endif
                       <form class="form-horizontal" wire:submit.prevent="saveSetting">
                           <div class="form-group">
                               <label class="col-md-4 control-label">Email</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="email" class="form-control input-md" wire:model="email">
                                @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Phone 1</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="phone1" class="form-control input-md" wire:model="phone1">
                                @error('phone1') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Phone2</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Phone2" class="form-control input-md" wire:model="phone2">
                                @error('phone2') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Address</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Address" class="form-control input-md" wire:model="address">
                                @error('address') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Map</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Map" class="form-control input-md" wire:model="map">
                                @error('map') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Twiter</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Twiter" class="form-control input-md" wire:model="twiter">
                                @error('twiter') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Facebook</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Facebook" class="form-control input-md" wire:model="facebook" >
                                @error('facebook') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Pinterest</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Map" class="form-control input-md" wire:model="pinterest">
                                @error('pinterest') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                          
                           <div class="form-group">
                               <label class="col-md-4 control-label">Insta</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Insta" class="form-control input-md" wire:model="instagram">
                                @error('instagram') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label">Youtube</label>
                               <div class="col-md-4">
                                <input type="text"  placeholder="Youtube" class="form-control input-md" wire:model="youtube">
                                @error('youtube') <p class="text-danger">{{ $message }}</p> @enderror
                               </div>                              
                           </div>
                           <div class="form-group">
                               <label class="col-md-4 control-label"></label>
                               <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                               </div>                              
                           </div>
                           
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
