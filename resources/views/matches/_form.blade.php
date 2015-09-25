<div class="row">


            {{csrf_field()}}
            <div class="row">
                <div class="form-group col s12">
                    <input id="name" name="name" type="text" placeholder="Complete Match Name" value="{{ $match->name or "" }}" >
                    <label for="name">Match Name</label>
                </div>
            </div>
            <div class="row">
                <div class="form-group col s6">
                    <input id="short_name" name="short_name" type="text" placeholder="Eg: 58thNSCC" value="{{$match->short_name or ""}}">
            <label for="short_name">Short Name</label>
                </div>
                <div class="form-group col s6">
                    <input id="year" name="year" type="text"  placeholder="Eg: 2015" value="{{$match->year or ""}}">
                    <label for="year">Competition Year</label>
                </div>
            </div>
            <div class="row">
                <div class="form-group col s12">
                    <input id="place" name="place" type="text" value="{{$match->place or ""}}" placeholder="Eg: Delhi">
                    <label for="place">Place</label>
                </div>
            </div>
                <div class="row">
                    <div class="form-group col s6">
                        <input id="start_date" name="start_date" class="datepicker" type="date" value="{{ isset($match)?date_format($match->start_date ,'d-m-Y') : ''}}">
                        <label for="start_date">Start Date</label>
                    </div>
                    <div class="form-group col s6">
                        <input id="end_date" name="end_date" class="datepicker" type="date" value="{{ isset($match)? date_format($match->end_date ,'d-m-Y') : '' }}">
                        <label for="end_date">End Date</label>
                    </div>
                </div>
            <div class="row">
                <div class="form-group col s12 ">
                    <input type="submit" class="btn btn-primary " value=" {{ $SubmitButtonText }}" >
                </div>

            </div>






</div>


