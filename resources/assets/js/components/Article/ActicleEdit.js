import React, { Component } from 'react';
import { Spin, Divider, message} from 'antd';
import { ArticleForm } from './ArticleForm';

export class ArticleEdit extends React.Component {
    constructor(props) {
        super();
        this.state = {
            //文章相关
            id: props.match.params.id,
            article: {},
            loading: true,
            //标签
            tags_arr: [],
            keywords_arr: []
        };
    }
    componentDidMount(props) {
        var that = this;
        //获取文章数据
        axios.get('/api/articles/' + this.state.id)
            .then(function (response) {
                that.setState({
                    article:response.data.article,
                    loading:false,
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
            //更新文章
            axios.post('/api/articles/update', {
                id:this.state.id,
                title:article.title,
                tags:article.tags,
                cover:article.cover,
                content:article.content,
            })
                .then(function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        message.success(response.data.message)
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
                <Spin spinning={this.state.loading}>
                    <Divider orientation="left">文 章 详 情</Divider>
                    <ArticleForm
                        article={this.state.article}
                        tags_arr={this.state.tags_arr}
                        keywords_arr={this.state.keywords_arr}
                        handleSubmit={this.handleSubmit.bind(this)}/>
                </Spin>
            </div>
        )
    }
}
