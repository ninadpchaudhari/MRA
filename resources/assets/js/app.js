
Vue.config.debug = true;
Vue.use(VueRouter);
var App = Vue.extend({});
var router = new VueRouter();

Vue.directive('select', {

    // Since we expect to sync value back to the vm,
    // we need to signal this is a two-way directive
    // so that we can use `this.set()` inside directive
    // functions.
    twoWay: true,

    bind: function () {
        var optionsData
        // retrive the value of the options attribute
        var optionsExpression = this.el.getAttribute('options')
        if (optionsExpression) {
            // if the value is present, evaluate the dynamic data
            // using vm.$eval here so that it supports filters too
            optionsData = this.vm.$eval(optionsExpression)
        }
        // initialize select2
        var self = this
        $(this.el)
            .select2({
                data: optionsData
            })
            .on('change', function () {
                // sync the data to the vm on change.
                // `self` is the directive instance
                // `this` points to the <select> element
                self.set(this.value)
            })
    },

    update: function (value) {
        // sync vm data change to select2
        $(this.el).val(value).trigger('change')
    },

    unbind: function () {
        // don't forget to teardown listeners and stuff.
        $(this.el).off().select2('destroy')
    }
})
var firstPage= Vue.extend(require("./components/firstPage/index"));
var shooterInfo = Vue.extend(require("./components/shooterInfo/index"));
Vue.component('tabs-nrai',require("./components/tabsNraiID/index"));

router.map({
    '/':{
        component : firstPage
    },
    'shooterInfo/:nraiID' : {
        component : shooterInfo
    }
});
router.start(App,'#app');
