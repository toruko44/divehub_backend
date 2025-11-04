/**
 * Custom Color Tool for EditorJS - Fixed Implementation
 */

export class ColorTool {
  static get isInline() {
    return true;
  }

  static get sanitize() {
    return {
      span: {
        style: true,
        class: true
      }
    };
  }

  constructor({ api }) {
    this.api = api;
    this.button = null;
    this.state = false;
    this.tag = 'SPAN';
    this.CSS = {
      button: 'ce-inline-tool',
      buttonActive: 'ce-inline-tool--active',
      buttonModifier: 'ce-inline-tool--color'
    };
  }

  render() {
    this.button = document.createElement('button');
    this.button.type = 'button';
    this.button.className = this.CSS.button;
    this.button.innerHTML = `
      <svg width="16" height="16" viewBox="0 0 16 16">
        <path d="M2 12l2-6h8l2 6H2z" fill="currentColor"/>
        <rect x="2" y="13" width="12" height="2" fill="#ff0000"/>
      </svg>
    `;
    this.button.title = '文字色';
    
    return this.button;
  }

  surround(range) {
    if (this.state) {
      this.unwrap(range);
      return;
    }

    this.wrap(range);
  }

  wrap(range) {
    const selectedText = range.extractContents();
    const span = document.createElement(this.tag);
    
    // すぐにカラーピッカーを表示
    this.showColorPicker((color) => {
      span.style.color = color;
      span.appendChild(selectedText);
      range.insertNode(span);
      
      // Selection APIを使って適切に選択範囲を設定
      this.api.selection.expandToTag(span);
    });
  }

  unwrap(range) {
    const termWrapper = this.api.selection.findParentTag(this.tag);
    const text = range.extractContents();
    
    if (termWrapper) {
      termWrapper.remove();
      range.insertNode(text);
    }
  }

  checkState() {
    const termTag = this.api.selection.findParentTag(this.tag);
    
    this.state = !!termTag;
    
    if (this.state) {
      this.button.classList.add(this.CSS.buttonActive);
    } else {
      this.button.classList.remove(this.CSS.buttonActive);
    }
    
    return this.state;
  }

  showColorPicker(callback) {
    const colors = [
      '#FF0000', '#FF8C00', '#FFD700', '#32CD32', '#00CED1',
      '#1E90FF', '#9370DB', '#FF1493', '#000000', '#808080'
    ];

    const colorPicker = document.createElement('div');
    colorPicker.style.cssText = `
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      z-index: 10000;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 8px;
    `;

    colors.forEach(color => {
      const colorButton = document.createElement('button');
      colorButton.style.cssText = `
        width: 32px;
        height: 32px;
        border: 2px solid #ddd;
        border-radius: 4px;
        background-color: ${color};
        cursor: pointer;
        transition: transform 0.2s;
      `;
      
      colorButton.addEventListener('mouseover', () => {
        colorButton.style.transform = 'scale(1.1)';
      });
      
      colorButton.addEventListener('mouseout', () => {
        colorButton.style.transform = 'scale(1)';
      });
      
      colorButton.addEventListener('click', () => {
        callback(color);
        document.body.removeChild(colorPicker);
      });
      
      colorPicker.appendChild(colorButton);
    });

    // キャンセルボタン
    const cancelButton = document.createElement('button');
    cancelButton.textContent = 'キャンセル';
    cancelButton.style.cssText = `
      grid-column: 1 / -1;
      padding: 8px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background: #f5f5f5;
      cursor: pointer;
    `;
    
    cancelButton.addEventListener('click', () => {
      document.body.removeChild(colorPicker);
    });
    
    colorPicker.appendChild(cancelButton);
    document.body.appendChild(colorPicker);
  }

  static get title() {
    return '文字色';
  }
}

export class MarkerTool {
  static get isInline() {
    return true;
  }

  static get sanitize() {
    return {
      mark: {
        style: true,
        class: true
      }
    };
  }

  constructor({ api }) {
    this.api = api;
    this.button = null;
    this.state = false;
    this.tag = 'MARK';
    this.CSS = {
      button: 'ce-inline-tool',
      buttonActive: 'ce-inline-tool--active',
      buttonModifier: 'ce-inline-tool--marker'
    };
  }

  render() {
    this.button = document.createElement('button');
    this.button.type = 'button';
    this.button.className = this.CSS.button;
    this.button.innerHTML = `
      <svg width="16" height="16" viewBox="0 0 16 16">
        <rect x="2" y="4" width="12" height="8" rx="2" fill="#ffeb3b"/>
        <path d="M8 6l1 1-1 1-1-1z" fill="#ffc107"/>
      </svg>
    `;
    this.button.title = 'マーカー';
    
    return this.button;
  }

  surround(range) {
    if (this.state) {
      this.unwrap(range);
      return;
    }

    this.wrap(range);
  }

  wrap(range) {
    const selectedText = range.extractContents();
    const mark = document.createElement(this.tag);
    
    this.showColorPicker((color) => {
      mark.style.backgroundColor = color;
      mark.appendChild(selectedText);
      range.insertNode(mark);
      
      this.api.selection.expandToTag(mark);
    });
  }

  unwrap(range) {
    const termWrapper = this.api.selection.findParentTag(this.tag);
    const text = range.extractContents();
    
    if (termWrapper) {
      termWrapper.remove();
      range.insertNode(text);
    }
  }

  checkState() {
    const termTag = this.api.selection.findParentTag(this.tag);
    
    this.state = !!termTag;
    
    if (this.state) {
      this.button.classList.add(this.CSS.buttonActive);
    } else {
      this.button.classList.remove(this.CSS.buttonActive);
    }
    
    return this.state;
  }

  showColorPicker(callback) {
    const colors = [
      '#FFEB3B', '#FFC107', '#FF9800', '#FF5722', '#F44336',
      '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3'
    ];

    const colorPicker = document.createElement('div');
    colorPicker.style.cssText = `
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      z-index: 10000;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 8px;
    `;

    colors.forEach(color => {
      const colorButton = document.createElement('button');
      colorButton.style.cssText = `
        width: 32px;
        height: 32px;
        border: 2px solid #ddd;
        border-radius: 4px;
        background-color: ${color};
        cursor: pointer;
        transition: transform 0.2s;
      `;
      
      colorButton.addEventListener('mouseover', () => {
        colorButton.style.transform = 'scale(1.1)';
      });
      
      colorButton.addEventListener('mouseout', () => {
        colorButton.style.transform = 'scale(1)';
      });
      
      colorButton.addEventListener('click', () => {
        callback(color);
        document.body.removeChild(colorPicker);
      });
      
      colorPicker.appendChild(colorButton);
    });

    // キャンセルボタン
    const cancelButton = document.createElement('button');
    cancelButton.textContent = 'キャンセル';
    cancelButton.style.cssText = `
      grid-column: 1 / -1;
      padding: 8px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background: #f5f5f5;
      cursor: pointer;
    `;
    
    cancelButton.addEventListener('click', () => {
      document.body.removeChild(colorPicker);
    });
    
    colorPicker.appendChild(cancelButton);
    document.body.appendChild(colorPicker);
  }

  static get title() {
    return 'マーカー';
  }
}