export class Container {    
    bind(name, item) {
        this.box = []
        this.box.push({name: name, item: item})
    }

    has(name) {
        return this.box[name] ? true : false;
    }

    resolve(name, def) {
        if (this.has(name)) {
            returnthis.box.filter(function(elem) {
                elem.name == name;
            }
        }
        return def;
    }
}