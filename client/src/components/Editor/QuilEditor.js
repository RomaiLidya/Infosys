import React from 'react';
import ReactQuill, { Quill } from 'react-quill';
import "react-quill/dist/quill.snow.css";

import axios from 'axios';
const __ISMSIE__ = navigator.userAgent.match(/Trident/i) ? true : false;

// Quill.register('modules/clipboard', PlainClipboard, true);

const QuillClipboard = Quill.import('modules/clipboard');
class Clipboard extends QuillClipboard {

    getMetaTagElements = (stringContent) => {
        const el = document.createElement('div');
        el.innerHTML = stringContent;
        return el.getElementsByTagName('meta');
    };

    async onPaste(e) {
        let clipboardData = e.clipboardData || window.clipboardData;
        let pastedData = await clipboardData.getData('Text');

        const urlMatches = pastedData.match(/\b(http|https)?:\/\/\S+/gi) || [];
        if (urlMatches.length > 0) {
            e.preventDefault();
            urlMatches.forEach(link => {
                axios.get(link)
                    .then(payload => {
                        // let title, image, url, description;
                        let title, image, url;
                        for (let node of this.getMetaTagElements(payload)) {
                            if (node.getAttribute("property") === "og:title") {
                                title = node.getAttribute("content");
                            }
                            if (node.getAttribute("property") === "og:image") {
                                image = node.getAttribute("content");
                            }
                            if (node.getAttribute("property") === "og:url") {
                                url = node.getAttribute("content");
                            }
                            // if (node.getAttribute("property") === "og:description") {
                            //     description = node.getAttribute("content");
                            // }
                        }

                        const rendered = `<a href=${url} target="_blank"><div><img src=${image} alt=${title} width="20%"/><span>${title}</span></div></a>`;

                        let range = this.quill.getSelection();
                        let position = range ? range.index : 0;
                        this.quill.pasteHTML(position, rendered, 'silent');
                        this.quill.setSelection(position + rendered.length);
                    })
                    .catch(error => console.error(error));
            });

        } else {
            //console.log('when to use this') ?????? ?????? ?????????  paste ????????????  copy?????? ?????? ?????? ??????. 
            super.onPaste(e);
        }
    }

}
Quill.register('modules/clipboard', Clipboard, true);

const BlockEmbed = Quill.import('blots/block/embed');

class ImageBlot extends BlockEmbed {

    static create(value) {
        const imgTag = super.create();
        imgTag.setAttribute('src', value.src);
        imgTag.setAttribute('alt', value.alt);
        imgTag.setAttribute('width', '100%');
        return imgTag;
    }

    static value(node) {
        return { src: node.getAttribute('src'), alt: node.getAttribute('alt') };
    }

}

ImageBlot.blotName = 'image';
ImageBlot.tagName = 'img';
Quill.register(ImageBlot);

class VideoBlot extends BlockEmbed {

    static create(value) {
        if (value && value.src) {
            const videoTag = super.create();
            videoTag.setAttribute('src', value.src);
            videoTag.setAttribute('title', value.title);
            videoTag.setAttribute('width', '100%');
            videoTag.setAttribute('controls', '');

            return videoTag;
        } else {
            const iframeTag = document.createElement('iframe');
            iframeTag.setAttribute('src', value);
            iframeTag.setAttribute('frameborder', '0');
            iframeTag.setAttribute('allowfullscreen', true);
            iframeTag.setAttribute('width', '100%');
            return iframeTag;
        }
    }

    static value(node) {
        if (node.getAttribute('title')) {
            return { src: node.getAttribute('src'), alt: node.getAttribute('title') };
        } else {
            return node.getAttribute('src');
        }
        // return { src: node.getAttribute('src'), alt: node.getAttribute('title') };
    }

}

VideoBlot.blotName = 'video';
VideoBlot.tagName = 'video';
Quill.register(VideoBlot);

class FileBlot extends BlockEmbed {

    static create(value) {
        const prefixTag = document.createElement('span');
        prefixTag.innerText = "???????????? - ";

        const bTag = document.createElement('b');
        //?????? ???????????? ?????? ??????  ?????? ????????? b ????????? ???????????? ?????????.
        bTag.innerText = value;

        const linkTag = document.createElement('a');
        linkTag.setAttribute('href', value);
        linkTag.setAttribute("target", "_blank");
        linkTag.setAttribute("className", "file-link-inner-post");
        linkTag.appendChild(bTag);
        //linkTag ??????????????? ????????? <a href="btn_editPic@3x.png" target="_blank" classname="file-link-inner-post"><b>btn_editPic@3x.png</b></a>

        const node = super.create();
        node.appendChild(prefixTag);
        node.appendChild(linkTag);

        return node;
    }

    static value(node) {
        const linkTag = node.querySelector('a');
        return linkTag.getAttribute('href');
    }

}

FileBlot.blotName = 'file';
FileBlot.tagName = 'p';
FileBlot.className = 'file-inner-post';
Quill.register(FileBlot);

class PollBlot extends BlockEmbed {

    static create(value) {
        const prefixTag = document.createElement('span');
        prefixTag.innerText = "?????? - ";

        const bTag = document.createElement('b');
        bTag.innerText = value.title;

        const node = super.create();
        node.setAttribute('id', value.id);
        node.appendChild(prefixTag);
        node.appendChild(bTag);

        return node;
    }

    static value(node) {
        const id = node.getAttribute('id');
        const bTag = node.querySelector('b');
        const title = bTag.innerText;
        return { id, title };
    }

}

PollBlot.blotName = 'poll';
PollBlot.tagName = 'p';
PollBlot.className = 'poll-inner-post';
Quill.register(PollBlot);

class QuillEditor extends React.Component {

    bandId;
    placeholder;
    onEditorChange;
    onFilesChange;
    onPollsChange;
    _isMounted;
    value;

    constructor(props) {
        
        super(props);

        this.state = {
            editorHtml: __ISMSIE__ ? "<p>&nbsp;</p>" : props.value,
            files: [],
        };

        this.reactQuillRef = null;

        this.inputOpenImageRef = React.createRef();
        this.inputOpenVideoRef = React.createRef();
        this.inputOpenFileRef = React.createRef();
    }

    componentDidMount() {
        this._isMounted = true;
    }

    componentWillUnmount() {
        this._isMounted = false;
    }

    handleChange = (html) => {
        console.log('handleChange', html)
        // https://youtu.be/BbR-QCoKngE
        // https://www.youtube.com/embed/ZwKhufmMxko
        // https://tv.naver.com/v/9176888
        // renderToStaticMarkup(ReactHtmlParser(html, options));

        this.setState({
            editorHtml: html
        }, () => {
            this.props.onEditorChange(this.state.editorHtml);
        });        
    };

    // I V F P??????  ???????????? insertImage: this.imageHandler??? ??????  ????????? inputOpenImageRef??? ?????? ?????????. 
    imageHandler = () => {
        this.inputOpenImageRef.current.click();
    };

    videoHandler = () => {
        this.inputOpenVideoRef.current.click();
    };

    fileHandler = () => {
        this.inputOpenFileRef.current.click();
    };


    insertImage = (e) => {
        e.stopPropagation();
        e.preventDefault();

        if (e.currentTarget && e.currentTarget.files && e.currentTarget.files.length > 0) {
            const file = e.currentTarget.files[0];

            let formData = new FormData();
            const config = {
                header: { 'content-type': 'multipart/form-data' }
            }
            formData.append("file", file);

            axios.post('/api/blog/uploadfiles', formData, config)
                .then(response => {
                    if (response.data.success) {

                        const quill = this.reactQuillRef.getEditor();
                        quill.focus();

                        let range = quill.getSelection();
                        let position = range ? range.index : 0;

                        //?????? ?????? ??????????????? ???????????? ?????? ?????????   ?????? ????????? src????????? ?????? ????????? ?????? 
                        //????????? ???????????? ??????  ?????????????????? ???????????? ?????? ?????? ?????? ????????????     src ??? alt ??? ???????????????  editorHTML??? ?????? ?????????.
                        quill.insertEmbed(position, "image", { src: "http://localhost:5000/" + response.data.url, alt: response.data.fileName });
                        quill.setSelection(position + 1);

                        if (this._isMounted) {
                            this.setState({
                                files: [...this.state.files, file]
                            }, () => { this.props.onFilesChange(this.state.files) });
                        }
                    } else {
                        return alert('failed to upload file')
                    }
                })
        }
    };

    insertVideo = (e) => {
        e.stopPropagation();
        e.preventDefault();

        if (e.currentTarget && e.currentTarget.files && e.currentTarget.files.length > 0) {
            const file = e.currentTarget.files[0];

            let formData = new FormData();
            const config = {
                header: { 'content-type': 'multipart/form-data' }
            }
            formData.append("file", file);

            axios.post('/api/blog/uploadfiles', formData, config)
                .then(response => {
                    if (response.data.success) {

                        const quill = this.reactQuillRef.getEditor();
                        quill.focus();

                        let range = quill.getSelection();
                        let position = range ? range.index : 0;
                        quill.insertEmbed(position, "video", { src: "http://localhost:5000/" + response.data.url, title: response.data.fileName });
                        quill.setSelection(position + 1);

                        if (this._isMounted) {
                            this.setState({
                                files: [...this.state.files, file]
                            }, () => { this.props.onFilesChange(this.state.files) });
                        }
                    } else {
                        return alert('failed to upload file')
                    }
                })
        }
    }

    insertFile = (e) => {
        e.stopPropagation();
        e.preventDefault();

        if (e.currentTarget && e.currentTarget.files && e.currentTarget.files.length > 0) {
            const file = e.currentTarget.files[0];
            console.log(file);

            let formData = new FormData();
            const config = {
                header: { 'content-type': 'multipart/form-data' }
            }
            formData.append("file", file);

            axios.post('/api/blog/uploadfiles', formData, config)
                .then(response => {
                    if (response.data.success) {

                        const quill = this.reactQuillRef.getEditor();
                        quill.focus();

                        let range = quill.getSelection();
                        let position = range ? range.index : 0;
                        quill.insertEmbed(position, "file", response.data.fileName);
                        quill.setSelection(position + 1);

                        if (this._isMounted) {
                            this.setState({
                                files: [...this.state.files, file]
                            }, () => { this.props.onFilesChange(this.state.files) });
                        }
                    };
                })
        }
    };

    render() {
        return (
            <div>
                <div id="toolbar">
                    <select className="ql-header" defaultValue={""} onChange={e => e.persist()}>
                        <option value="1" />
                        <option value="2" />
                        <option value="" />
                    </select>
                    <button className="ql-bold" />
                    <button className="ql-italic" />
                    <button className="ql-underline" />
                    <button className="ql-strike" />
                    <button className="ql-link" />
                    <span className="ql-format-group">
        <span title="Bold" className="ql-format-button ql-bold"/>
        <span className="ql-format-separator"/>
        <span title="Italic" className="ql-format-button ql-italic"/>
        <span className="ql-format-separator"/>
        <span title="Underline" className="ql-format-button ql-underline"/>
        <span className="ql-format-separator"/>
        <span title="Strikethrough" className="ql-format-button ql-strike"/>
    </span>
    <span className="ql-format-group">
        <select title="Text Color" className="ql-color" defaultValue="rgb(0, 0, 0)">
          <option value="rgb(0, 0, 0)" label="rgb(0, 0, 0)"/>
          <option value="rgb(230, 0, 0)" label="rgb(230, 0, 0)"/>
          <option value="rgb(255, 153, 0)" label="rgb(255, 153, 0)"/>
          <option value="rgb(255, 255, 0)" label="rgb(255, 255, 0)"/>
          <option value="rgb(0, 138, 0)" label="rgb(0, 138, 0)"/>
          <option value="rgb(0, 102, 204)" label="rgb(0, 102, 204)"/>
          <option value="rgb(153, 51, 255)" label="rgb(153, 51, 255)"/>
          <option value="rgb(250, 204, 204)" label="rgb(250, 204, 204)"/>
          <option value="rgb(255, 235, 204)" label="rgb(255, 235, 204)"/>
          <option value="rgb(255, 255, 204)" label="rgb(255, 255, 204)"/>
          <option value="rgb(204, 232, 204)" label="rgb(204, 232, 204)"/>
          <option value="rgb(204, 224, 245)" label="rgb(204, 224, 245)"/>
          <option value="rgb(235, 214, 255)" label="rgb(235, 214, 255)"/>
          <option value="rgb(187, 187, 187)" label="rgb(187, 187, 187)"/>
          <option value="rgb(240, 102, 102)" label="rgb(240, 102, 102)"/>
          <option value="rgb(255, 194, 102)" label="rgb(255, 194, 102)"/>
          <option value="rgb(255, 255, 102)" label="rgb(255, 255, 102)"/>
          <option value="rgb(102, 185, 102)" label="rgb(102, 185, 102)"/>
          <option value="rgb(102, 163, 224)" label="rgb(102, 163, 224)"/>
          <option value="rgb(194, 133, 255)" label="rgb(194, 133, 255)"/>
          <option value="rgb(136, 136, 136)" label="rgb(136, 136, 136)"/>
          <option value="rgb(161, 0, 0)" label="rgb(161, 0, 0)"/>
          <option value="rgb(178, 107, 0)" label="rgb(178, 107, 0)"/>
          <option value="rgb(178, 178, 0)" label="rgb(178, 178, 0)"/>
          <option value="rgb(0, 97, 0)" label="rgb(0, 97, 0)"/>
          <option value="rgb(0, 71, 178)" label="rgb(0, 71, 178)"/>
          <option value="rgb(107, 36, 178)" label="rgb(107, 36, 178)"/>
          <option value="rgb(68, 68, 68)" label="rgb(68, 68, 68)"/>
          <option value="rgb(92, 0, 0)" label="rgb(92, 0, 0)"/>
          <option value="rgb(102, 61, 0)" label="rgb(102, 61, 0)"/>
          <option value="rgb(102, 102, 0)" label="rgb(102, 102, 0)"/>
          <option value="rgb(0, 55, 0)" label="rgb(0, 55, 0)"/>
          <option value="rgb(0, 41, 102)" label="rgb(0, 41, 102)"/>
          <option value="rgb(61, 20, 102)" label="rgb(61, 20, 102)"/>
        </select>
        <span className="ql-format-separator"/>
        <select title="Background Color" className="ql-background" defaultValue="rgb(255, 255, 255)">
            <option value="rgb(0, 0, 0)" label="rgb(0, 0, 0)"/>
            <option value="rgb(230, 0, 0)" label="rgb(230, 0, 0)"/>
          <option value="rgb(255, 153, 0)" label="rgb(255, 153, 0)"/>
          <option value="rgb(255, 255, 0)" label="rgb(255, 255, 0)"/>
          <option value="rgb(0, 138, 0)" label="rgb(0, 138, 0)"/>
          <option value="rgb(0, 102, 204)" label="rgb(0, 102, 204)"/>
          <option value="rgb(153, 51, 255)" label="rgb(153, 51, 255)"/>
          <option value="rgb(255, 255, 255)" label="rgb(255, 255, 255)"/>
          <option value="rgb(250, 204, 204)" label="rgb(250, 204, 204)"/>
          <option value="rgb(255, 235, 204)" label="rgb(255, 235, 204)"/>
          <option value="rgb(255, 255, 204)" label="rgb(255, 255, 204)"/>
          <option value="rgb(204, 232, 204)" label="rgb(204, 232, 204)"/>
          <option value="rgb(204, 224, 245)" label="rgb(204, 224, 245)"/>
          <option value="rgb(235, 214, 255)" label="rgb(235, 214, 255)"/>
          <option value="rgb(187, 187, 187)" label="rgb(187, 187, 187)"/>
          <option value="rgb(240, 102, 102)" label="rgb(240, 102, 102)"/>
          <option value="rgb(255, 194, 102)" label="rgb(255, 194, 102)"/>
          <option value="rgb(255, 255, 102)" label="rgb(255, 255, 102)"/>
          <option value="rgb(102, 185, 102)" label="rgb(102, 185, 102)"/>
          <option value="rgb(102, 163, 224)" label="rgb(102, 163, 224)"/>
          <option value="rgb(194, 133, 255)" label="rgb(194, 133, 255)"/>
          <option value="rgb(136, 136, 136)" label="rgb(136, 136, 136)"/>
          <option value="rgb(161, 0, 0)" label="rgb(161, 0, 0)"/>
          <option value="rgb(178, 107, 0)" label="rgb(178, 107, 0)"/>
          <option value="rgb(178, 178, 0)" label="rgb(178, 178, 0)"/>
          <option value="rgb(0, 97, 0)" label="rgb(0, 97, 0)"/>
          <option value="rgb(0, 71, 178)" label="rgb(0, 71, 178)"/>
          <option value="rgb(107, 36, 178)" label="rgb(107, 36, 178)"/>
          <option value="rgb(68, 68, 68)" label="rgb(68, 68, 68)"/>
          <option value="rgb(92, 0, 0)" label="rgb(92, 0, 0)"/>
          <option value="rgb(102, 61, 0)" label="rgb(102, 61, 0)"/>
          <option value="rgb(102, 102, 0)" label="rgb(102, 102, 0)"/>
          <option value="rgb(0, 55, 0)" label="rgb(0, 55, 0)"/>
          <option value="rgb(0, 41, 102)" label="rgb(0, 41, 102)"/>
          <option value="rgb(61, 20, 102)" label="rgb(61, 20, 102)"/>
        </select>
    </span>
                  

                    

                </div>
                <ReactQuill
                    ref={(el) => { this.reactQuillRef = el }}
                    theme={'snow'}
                    onChange={this.handleChange}
                    modules={this.modules}
                    formats={this.formats}
                    value={this.state.editorHtml}
                    placeholder={this.props.placeholder}
                />
                <input type="file" accept="image/*" ref={this.inputOpenImageRef} style={{ display: "none" }} onChange={this.insertImage} />
               </div>
        )
    }

    modules = {
        syntax: false,
        toolbar: {
            container: "#toolbar",
            //id ="toorbar"???  ??? ?????? B I U S I V F P ?????? ?????? ?????????. 
            handlers: {
                insertImage: this.imageHandler,
                insertVideo: this.videoHandler,
                insertFile: this.fileHandler,
                insertPoll: this.pollHandler,
            }
        },

    };

    formats = [ 
        'header',
        'bold', 'italic', 'underline', 'strike',
        'link', "blockquote", "clean", "color"
    ];
}

export default QuillEditor;
