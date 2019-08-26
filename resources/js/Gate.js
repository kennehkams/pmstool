export default class Gate{
    
    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }

    isOperation(){
        return this.user.type === 'operation';
    }

    isAdminOrOperation(){
        if(this.user.type === 'admin' || this.user.type === 'operation'){
            return true;
        }
    }

    isFinance(){
        return this.user.type === 'finance';
    }

    isHr(){
        return this.user.type === 'hr';
    }

    isPmanager(){
        return this.user.type === 'pmanager';
    }

    isTleader(){
        return this.user.type === 'tleader';
    }

    isAgent(){
        return this.user.type === 'agent';
    }

    isDriver(){
        return this.user.type === 'driver';
    }
}
