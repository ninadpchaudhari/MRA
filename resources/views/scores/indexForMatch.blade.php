@extends('admin-app')
@section('content')
    <h2>Scores for Match : {{$match->short_name}} {{ $match->year }}</h2>
    <hr>
    @foreach($classes as $classKey=>$classValue)
        <h3>{{$classValue}}</h3>
        <div id="info_{{$classKey}}"></div>
    @endforeach
    <div id="example1" class="hot handsontable"></div>
    @endsection
@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function getData() {
                return [
                    ['', 'Kia', 'Nissan', 'Toyota', 'Honda', 'Mazda', 'Ford'],
                    ['2012', 10, 11, 12, 13, 15, 16],
                    ['2013', 10, 11, 12, 13, 15, 16],
                    ['2014', 10, 11, 12, 13, 15, 16],
                    ['2015', 10, 11, 12, 13, 15, 16],
                    ['2016', 10, 11, 12, 13, 15, 16]
                ];
            }

            // Instead of creating a new Handsontable instance
            // with the container element passed as an argument,
            // you can simply call .handsontable method on a jQuery DOM object.
            var $container = $("#example1");

            $container.handsontable({
                data: getData(),
                rowHeaders: true,
                colHeaders: true,
                contextMenu: true
            });

            // This way, you can access Handsontable api methods by passing their names as an argument, e.g.:
            var hotInstance = $("#example1").handsontable('getInstance');
            console.log(hotInstance);
            function bindDumpButton() {
                if (typeof Handsontable === "undefined") {
                    return;
                }

                Handsontable.Dom.addEvent(document.body, 'click', function (e) {

                    var element = e.target || e.srcElement;

                    if (element.nodeName == "BUTTON" && element.name == 'dump') {
                        var name = element.getAttribute('data-dump');
                        var instance = element.getAttribute('data-instance');
                        var hot = window[instance];
                        console.log('data of ' + name, hot.getData());
                    }
                });
            }
            bindDumpButton();

        });
    </script>
@endsection