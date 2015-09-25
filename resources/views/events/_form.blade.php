{{ csrf_field() }}
<input type="hidden" name="match_id" id="match_id" value="{{isset($match)? $match->id : $event->match_id}}">
<br>
<div class="input-field">
    <input
            type="text"
            id="name" name="name"
            placeholder="Eg : N-01,N-02"
            value="{{ $event->name or "" }}"
            >
    <label for="name">Name</label>
</div>


<select name="class" id="class" class="browser-default">
    <option value="" disabled selected>Select the Class</option>
    @foreach($decodeArray['classes'] as $class)
        <option value="{{$class}}"
                @if(isset($event) ? $class == $event->class : false)
                selected
                @endif
                >{{ $class }}</option>
    @endforeach
</select>
<label for="class">Select Class</label>

<label for="type">Type of Match</label>
<select name="type" id="type" class="browser-default">
    <option value="" disabled selected>Select Type</option>
    @foreach($decodeArray['types'] as $type)
        <option value="{{$type}}"
                @if(isset($event) ? $type == $event->type :  false)
                    selected
                @endif
                >{{ $type }}</option>
    @endforeach
</select>


<label for="gender">Gender</label>
<select name="gender" id="gender" class="browser-default">
    <option value="" disabled selected>Select Gender</option>
    @foreach($decodeArray['genders'] as $gender)
        <option value="{{$gender}}"
                @if(isset($event) ? $gender == $event->gender : false)
                    selected
                @endif
                >{{ $gender }}</option>
    @endforeach
</select>




<label for="category">Category</label>
<select name="category" id="category" class="browser-default">
    <option value="" disabled selected>Select Category</option>
    @foreach($decodeArray['categories'] as $category)
        <option value="{{$category}}"
                @if(isset($event) ? $category == $event->category : false)
                    selected
                @endif
                >{{$category}}</option>
    @endforeach

</select>

<p>
    <input type="checkbox" id="isDecimal" name="isDecimal"
            @if(isset($event) ? $event->isDecimal : "")
                checked
           @endif
            >
    <label for="isDecimal">Is Score Decimal</label>
</p>


<div class="input-field">
    <input type="number" name="max_score" id="max_score"
            value="{{ isset($event) ? $event->max_score : ""}}"
            >
    <label for="max_score">Maximum Score</label>
</div>


<input type="submit" value="{{$SubmitButtonText}}" class="btn btn-primary">
@include('errors.list')