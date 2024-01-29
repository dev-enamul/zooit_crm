<input type="hidden" name="id" value="{{$data->id}}">
<div class="form-group mb-2">
    <label for="title">Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="title" value="{{$data->title}}" name="title" required>
</div> 

<div class="form-group mb-2">
    <label for="commission">Commission [%]<span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="commission" value="{{$data->commission}}" name="commission" required>
</div>  
 

<div class="form-group mb-2">
    <label for="commission_holder">Commission Holder<span class="text-danger">*</span></label>
    <select id="edit_commission_holder" class="select2" multiple name="commission_holder[]" required>
        @foreach ($designations as $item)
            <option {{ in_array($item->id, $selected_designation) ? 'selected' : '' }} value="{{$item->id}}">{{$item->title}}</option>  
        @endforeach  
    </select> 
</div> 