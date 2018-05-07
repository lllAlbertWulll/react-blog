import React, {Component} from 'react';
import {Icon, Form, Input, Button, Upload, message, Modal, Badge, Select, DatePicker} from 'antd';
import moment from 'moment';
import BraftEditor from 'braft-editor'
import 'braft-editor/dist/braft.css'

const FormItem = Form.Item;
const {TextArea} = Input;
const Option = Select.Option;

export class ArticleForm extends React.Component {
    constructor(props) {
        super();
        this.state = {
            //封面文件缓存
            coverList: [],
            //表单
            id: 0,
            title: '',
            subtitle: '',
            tags: [],
            keywords: [],
            cover: '',
            content: '',
            published_at: '',
            //可选标签
            tags_arr: [],
            keywords_arr: [],
        }
    }

    componentWillReceiveProps(nextProps) {
        if (nextProps.article) {
            this.setState({
                id: nextProps.article.id,
                title: nextProps.article.title,
                subtitle: nextProps.article.subtitle,
                tags: nextProps.article.tags,
                keywords: nextProps.article.keywords,
                cover: nextProps.article.cover,
                content: nextProps.article.content,
                published_at: nextProps.article.published_at,
            });
        }
        if (nextProps.tags_arr) {
            this.setState({
                tags_arr: nextProps.tags_arr,
            });
        }
        if (nextProps.keywords_arr) {
            this.setState({
                keywords_arr: nextProps.keywords_arr,
            });
        }
    }

    handelTitleChange() {
        let title = this.refs.title.input.value;
        this.setState({title: title})
    };

    handelSubtitleChange() {
        let subtitle = this.refs.subtitle.input.value;
        this.setState({subtitle: subtitle})
    };

    handleTagsChange(value) {
        this.setState({tags: value});
        console.log(value)
    };

    handleKeywordsChange(value) {
        this.setState({keywords: value});
        console.log(value)
    };

    handleChange(content) {
        this.setState({content: content});
        console.log(content);
    };

    uploadFn(param) {
        const serverURL = '/api/upload/image';
        const xhr = new XMLHttpRequest;
        const fd = new FormData();
        // libraryId可用于通过mediaLibrary示例来操作对应的媒体内容
        const successFn = (response) => {
            // 假设服务端直接返回文件上传后的地址
            // 上传成功后调用param.success并传入上传后的文件地址
            param.success({
                url: JSON.parse(xhr.responseText).data,
                //url: response.data
            })
        };
        const progressFn = (event) => {
            // 上传进度发生变化时调用param.progress
            param.progress(event.loaded / event.total * 100);
        };
        const errorFn = (response) => {
            // 上传发生错误时调用param.error
            param.error({
                msg: 'unable to upload.',
            })
        };
        xhr.upload.addEventListener("progress", progressFn, false);
        xhr.addEventListener("load", successFn, false);
        xhr.addEventListener("error", errorFn, false);
        xhr.addEventListener("abort", errorFn, false);

        fd.append('file', param.file);
        xhr.open('POST', serverURL, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.head.querySelector('meta[name="csrf-token"]').content);
        xhr.send(fd)
    };

    coverChanged(event) {
        if (event.file.response) {
            this.setState({
                cover: event.file.response.data
            });
        }
    }

    beforeUpload(file) {
        console.log(file);
        if (this.state.coverList.length > 0) {
            return false;
        }
        else {
            this.setState({fileName: file.name});
            return true;
        }
    }

    render() {
        const formItemLayout = {
            wrapperCol: {
                sm: {span: 24},
                md: {span: 24},
                lg: {span: 20, offset: 2}
            },
        };
        const uploadProps = {
            name: 'cover',
            action: '/api/upload/cover',
            listType: 'picture',
            defaultFileList: [],
            showUploadList: true,
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            },
            onChange: this.coverChanged.bind(this)
        };
        const editorProps = {
            height: 350,
            contentFormat: 'html',
            initialContent: this.state.content,
            contentId: this.state.id,
            onChange: this.handleChange.bind(this),
            onHTMLChange: this.handleHTMLChange,
            media: {
                uploadFn: this.uploadFn
            },
            controls: [
                'undo', 'redo', 'split', 'font-size', 'font-family', 'text-color',
                'bold', 'italic', 'underline', 'strike-through', 'emoji', 'superscript',
                'subscript', 'text-align', 'split', 'headings', 'list_ul', 'list_ol',
                'blockquote', 'code', 'split', 'link', 'split', 'media'
            ],
        };
        //可选标签
        const tag_children = [];
        const keyword_children = [];
        var tags_arr = this.state.tags_arr;
        var keywords_arr = this.state.keywords_arr;
        for (var i = 0; i < tags_arr.length; i++) {
            tag_children.push(<Option key={tags_arr[i]}>{tags_arr[i]}</Option>);
        }
        for (var i = 0; i < keywords_arr.length; i++) {
            keyword_children.push(<Option key={keywords_arr[i]}>{keywords_arr[i]}</Option>);
        }
        return (
            <Form>
                <FormItem
                    {...formItemLayout}>
                    <Input
                        prefix={<Icon type="info-circle-o"/>}
                        placeholder="输入文章标题"
                        ref="title"
                        value={this.state.title}
                        onChange={this.handelTitleChange.bind(this)}/>
                </FormItem>
                <FormItem
                    {...formItemLayout}>
                    <Input
                        prefix={<Icon type="info-circle-o"/>}
                        placeholder="输入文章副标题"
                        ref="subtitle"
                        value={this.state.subtitle}
                        onChange={this.handelSubtitleChange.bind(this)}/>
                </FormItem>
                <FormItem
                    {...formItemLayout}>
                    <Select
                        mode="tags"
                        style={{width: '100%'}}
                        placeholder="添加标签"
                        ref="tags"
                        value={this.state.tags}
                        onChange={this.handleTagsChange.bind(this)}
                    >
                        {tag_children}
                    </Select>
                </FormItem>
                <FormItem
                    {...formItemLayout}>
                    <Select
                        mode="tags"
                        style={{width: '100%'}}
                        placeholder="添加文章关键词"
                        ref="keywords"
                        value={this.state.keywords}
                        onChange={this.handleKeywordsChange.bind(this)}
                    >
                        {keyword_children}
                    </Select>
                </FormItem>
                <FormItem {...formItemLayout}>
                    <Upload {...uploadProps}>
                        <Button>
                            <Icon type="upload"/> 点击上传封面
                        </Button>
                    </Upload>
                </FormItem>
                <FormItem {...formItemLayout}>
                    <div style={{
                        borderRadius: 5,
                        boxShadow: 'inset 0 0 0 0.5px rgba(0, 0, 0, 0.3), 0 10px 20px rgba(0, 0, 0, 0.1)'
                    }}>
                        <BraftEditor {...editorProps}/>
                    </div>
                </FormItem>
                <FormItem {...formItemLayout}>
                    <DatePicker
                        showTime
                        style={{width: '100%'}}
                        format="YYYY-MM-DD HH:mm:ss"
                        placeholder="选择发布时间"
                        value={moment(this.state.published_at)}
                    />
                </FormItem>
                <FormItem {...formItemLayout} style={{textAlign: 'right'}}>
                    <Button
                        onClick={this.props.handleSubmit.bind(this, {
                            title: this.state.title,
                            subtitle: this.state.subtitle,
                            tags: this.state.tags,
                            keywords: this.state.keywords,
                            cover: this.state.cover,
                            content: this.state.content,
                        })}
                        type="primary"
                        htmlType="submit"
                        icon="form"> 保存
                    </Button>
                </FormItem>
            </Form>
        )
    }
}
