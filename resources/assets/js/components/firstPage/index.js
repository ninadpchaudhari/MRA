/**
 *
 * @param id
 * @returns true -> valid
 */
function validateNraiID(id){
    if(id.match(/(SHM|SHF)([123]0|[012][1-9]|31)(0[1-9]|1[012])(19[0-9]{2}|2[0-9]{3})\d\d/g)){
        return true;
    }
    return false;
};
module.exports={
    methods: {
        redirectToAthleteInfo : function(){
            //if(! validateNraiID(this.nraiID)) this.nraiIDIsInvalid = true;

            //Validation of nraiID
            //redirection to athleteInfo route
            console.log(this.nraiID);
            if(! validateNraiID(this.nraiID)) {alert("Invalid NRAI ID"); return false;}
            window.location = '#!/shooterInfo/'+this.nraiID;

            //window.location.href('/shooterInfo/'+this.nraiID);
        }
    },
    data:function(){
      return {
          nraiID : '',

          selected : 0,
          options: [
              { id: 1, text: 'hello' },
              { id: 2, text: 'what' }
          ]
      }
    },
    computed: {
        nraiIDIsInvalid : function(){
            if(validateNraiID(this.nraiID)) {
                return false;
            }
            return true;
        }
    },
    template : require('./template.html')
}
