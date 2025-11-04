class LineBreak {
    static get toolbox() {
        return {
            title: '改行',
            icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M5 11h14v2H5v-2zm-1-4h16v2H4V7zm16 8H4v2h16v-2z" fill="currentColor"/></svg>',
        };
    }

    render() {
        const div = document.createElement('div');
        div.style.height = '10px';
        div.style.margin = '5px 0';
        return div;
    }

    save(blockContent) {
        return {};
    }
}

export default LineBreak;
