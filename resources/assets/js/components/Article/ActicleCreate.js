import React from "react";
import { Divider, message} from 'antd';
import {ArticleForm} from "./ArticleForm";

export class ArticleCreate extends React.Component {
    constructor(props) {
        super();
        this.state = {
            tags_arr:[]
        };
    }
    componentDidMount(props) {
        var that = this
        //获取文章数据
        axios.get('z/tags')
            .then(function (response) {
                that.setState({
                    tags_arr:response.data.tags_arr,
                })
            })
            .catch(function (error) {
                console.log(error);
            });
    }
    handleSubmit(article) {
        console.log(article);
        var that = this;
        if (article.title == '') {
            message.error('标题不能为空');
        }else {
            //创建文章
            axios.post('z/articles', {
                title:article.title,
                tags:article.tags,
                cover:article.cover,
                content:article.content,
            })
                .then(function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        message.success(response.data.message)
                        location.replace('#/articles')
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
    render(){
        return (
            <div>
                <Divider orientation="left">写 下 新 篇 章</Divider>
                <ArticleForm tags_arr={this.state.tags_arr} handleSubmit={this.handleSubmit} />
            </div>
        )
    }
}