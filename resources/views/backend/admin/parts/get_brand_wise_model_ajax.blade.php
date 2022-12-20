<div class="form-group row">
    <label for="model_id" class="col-sm-4 col-form-label">Select Model</label>
    <div class="col-sm-8">
        <select name="model_id" id="model_id" class="form-control">
            @foreach ($models as $model)
                <option value="{{ $model->id }}">
                    {{ $model->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
