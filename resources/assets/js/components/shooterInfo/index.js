

module.exports= {
    data: function(){
        return{
            athleteInfo : '',
            raw_athleteInfo : ''
        }
    },
    route: {

        activate: function (transition) {
            console.log('hook-example activated');
            transition.next();
        },
        deactivate: function (transition) {
            console.log('hook-example deactivated!');
            transition.next();
        },

        data: function (transition) {
            $.get("/api/athleteInfo/"+transition.to.params.nraiID, function (data) {
                console.log(data);
                var nraiIDobj = new Object();
                nraiIDobj['NRAI ID'] = data['shooterID'];
                nraiIDobj['Name'] = data['shooterName'];
                nraiIDobj['Mother\'Name'] = data['motherName'];
                nraiIDobj['Father\'s Name'] = data['fatherName'];
                nraiIDobj['State'] = data['state'];
                nraiIDobj['State/Org of Representation'] = data['stateOfRep'];
                nraiIDobj['Gender'] = data['sex'];
                nraiIDobj['Events'] = '';

                if(data['eventRifle'] == 1) nraiIDobj['Events'] += 'Rifle,'
                if(data['eventPistol'] == 1) nraiIDobj['Events'] += 'Pistol,'
                if(data['eventShotgun'] == 1) nraiIDobj['Events'] += 'Shotgun'
                transition.next({athleteInfo : nraiIDobj , raw_athleteInfo:data})
            });
        }
    },
    template: require('./template.html')
}