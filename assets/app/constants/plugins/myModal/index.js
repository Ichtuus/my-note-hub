const name = {
    ADD: 'add'
}

name.install = function (Vue) {
    Vue.prototype.$myModalConst = (key) => {
        if(name[key]) {
            return name[key];
        } else {
            console.error(key, 'constant doesn\'t exist')
        }
    }
}

export default name;
