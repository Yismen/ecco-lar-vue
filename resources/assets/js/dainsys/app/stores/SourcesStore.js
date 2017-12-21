export default {
    state: {
        sources: []
    },
    setSources(data) {
        this.state.sources = data;
    },

    addNewSource(source) {
        this.state.sources.push(source);
        console.log("Adding: ", this)

    },

    editSource(source) {
        // this.state.sources.unshift(source);
    },

    clearSources() {
        this.state.sources = []
    }
}