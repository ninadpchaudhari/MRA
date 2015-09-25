(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Vue.use(VueRouter);
var App = Vue.extend({});
var router = new VueRouter();

Vue.directive('select', {

    // Since we expect to sync value back to the vm,
    // we need to signal this is a two-way directive
    // so that we can use `this.set()` inside directive
    // functions.
    twoWay: true,

    bind: function bind() {
        var optionsData;
        // retrive the value of the options attribute
        var optionsExpression = this.el.getAttribute('options');
        if (optionsExpression) {
            // if the value is present, evaluate the dynamic data
            // using vm.$eval here so that it supports filters too
            optionsData = this.vm.$eval(optionsExpression);
        }
        // initialize select2
        var self = this;
        $(this.el).select2({
            data: optionsData
        }).on('change', function () {
            // sync the data to the vm on change.
            // `self` is the directive instance
            // `this` points to the <select> element
            self.set(this.value);
        });
    },

    update: function update(value) {
        // sync vm data change to select2
        $(this.el).val(value).trigger('change');
    },

    unbind: function unbind() {
        // don't forget to teardown listeners and stuff.
        $(this.el).off().select2('destroy');
    }
});
var firstPage = Vue.extend(require("./components/firstPage/index"));
var shooterInfo = Vue.extend(require("./components/shooterInfo/index"));
Vue.component('tabs-nrai', require("./components/tabsNraiID/index"));

router.map({
    '/': {
        component: firstPage
    },
    'shooterInfo/:nraiID': {
        component: shooterInfo
    }
});
router.start(App, '#app');

},{"./components/firstPage/index":2,"./components/shooterInfo/index":4,"./components/tabsNraiID/index":6}],2:[function(require,module,exports){
'use strict';

module.exports = {

    data: function data() {
        return {
            selected: 0,
            options: [{ id: 1, text: 'hello' }, { id: 2, text: 'what' }]
        };
    },
    template: require('./template.html')
};

},{"./template.html":3}],3:[function(require,module,exports){
module.exports = '\n<div  id="first-page" >\n    <div class="row"></div>\n\n    <div class="row">\n        <div class="input-field col s6">\n            <input type="text" id="nrai-id-field" length="13" v-model="nraiID">\n            <label for="nrai-id-field"> Enter Your Nrai ID card</label>\n        </div>\n        <div class="col s3">\n            <a class="waves-effect waves-light btn pink"\n               v-link="/shooterInfo/{{nraiID}}"\n                    ><i class="material-icons right">send</i>Continue</a>\n        </div>\n\n    </div>\n    <div class="row">\n        <div class="col s12">For Mavlankar Shooters</div>\n    </div>\n    <div class="row">\n        <div class="input-field col s6">\n            <input type="text" id="competitor-id-field">\n            <label for="competitor-id-field">Enter Your Mavlankar competitor ID</label>\n        </div>\n        <div class="col s3">\n            <a class="waves-effect waves-light btn pink"><i class="material-icons right">send</i>Continue</a>\n        </div>\n    </div>\n\n    <div class="row">\n        <div class="col s6">\n            <div id="el">\n                <p>Selected: {{selected}}</p>\n                <select v-select="selected" options="options" multiple>\n                    <option value="0">default</option>\n                </select>\n            </div>\n        </div>\n    </div>\n</div>';
},{}],4:[function(require,module,exports){
'use strict';

module.exports = {
    route: {

        activate: function activate(transition) {
            console.log('hook-example activated');
            transition.next();
        },
        deactivate: function deactivate(transition) {
            console.log('hook-example deactivated!');
            transition.next();
        },

        data: function data(transition) {
            setTimeout(function () {
                transition.next({
                    message: 'data fetched!'
                });
            }, 1000);
        }
    },

    template: require('./template.html'),
    data: function data() {
        return {
            nraiID: ''
        };
    }
};

},{"./template.html":5}],5:[function(require,module,exports){
module.exports = '\n<tabs-nrai ></tabs-nrai>\n<img src="{{}}" alt="Shooter Image" class="responsive-img">\n<p>Current route params: {{$route.params.nraiID | json}}</p>\n<p>Current route params: {{nraiID}}</p>\n<p>Current route params: {{message}}</p>\n<p></p>';
},{}],6:[function(require,module,exports){
'use strict';

module.exports = {

    inherit: true,
    template: require('./template.html')
};

},{"./template.html":7}],7:[function(require,module,exports){
module.exports = '<div class="row">\n    <div class="col s12">\n        <div class="progress">\n            <div class="determinate" style="width: 10%"></div>\n        </div>\n    </div>\n</div>\n<div class="row ">\n    <div class="col s12 ">\n\n        <ul class="tabs" id="tabstemplate">\n            <li class="tab col s3"><a href="#shooterInfo" class="active">Shooter Info</a></li>\n            <li class="tab col s3"><a href="#selectEvents">Events</a></li>\n            <li class="tab col s3"><a href="#confirmEvents">Confirmation</a></li>\n            <li class="tab col s3"><a href="#confirmMobile">Mobile Confirmation</a></li>\n        </ul>\n    </div>\n</div>\n\n<script>\n    $(document).ready(function(){\n        $(\'ul.tabs\').tabs(\'select_tab\', \'tab_id\');\n    });\n</script>';
},{}]},{},[1]);
