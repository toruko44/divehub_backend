class SimpleLinkTool {
    static get toolbox() {
        return {
            title: 'リンク',
            icon: '<svg width="18" height="18" viewBox="0 0 24 24"><path d="M3.9 12.9c.3 2.5 2.4 4.5 4.9 4.5h3v-1.5h-3c-1.6 0-2.9-1.3-2.9-2.9 0-1.6 1.3-2.9 2.9-2.9h3v-1.5h-3c-1.5 0-2.8 1.2-2.9 2.9zm16.2-2.9h-3v1.5h3c1.6 0 2.9 1.3 2.9 2.9 0 1.6-1.3 2.9-2.9 2.9h-3v1.5h3c2.5 0 4.6-2 4.9-4.5-.3-2.5-2.4-4.5-4.9-4.5zm-11.1 4.5h7.2v-1.5h-7.2v1.5z"/></svg>',
        };
    }

    constructor({ data }) {
        this.data = data || { url: '' };
        this.wrapper = null;
    }

    render() {
        this.wrapper = document.createElement('div');

        const input = document.createElement('input');
        input.type = 'url';
        input.placeholder = 'URLを入力してください...';
        input.value = this.data.url || '';
        input.classList.add('block', 'w-full', 'border', 'rounded', 'p-2');

        input.addEventListener('input', (event) => {
            this.data.url = event.target.value;
        });

        this.wrapper.appendChild(input);

        return this.wrapper;
    }

    save() {
        return {
            url: this.data.url,
        };
    }

    validate(savedData) {
        if (!savedData.url) {
            return false;
        }
        try {
            new URL(savedData.url); // URLの形式を検証
            return true;
        } catch {
            return false;
        }
    }
}

export default SimpleLinkTool;
