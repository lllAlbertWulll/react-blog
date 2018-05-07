import React from "react";
import {Link} from 'react-router-dom';
import {Table, Input, Button, Icon, Divider, message, Modal, Tooltip, Badge, Avatar} from 'antd';
import axios from 'axios';

const ButtonGroup = Button.Group;
const confirm = Modal.confirm;

export class Article extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            //文章数据
            articles: [],
            articles_back: [],
            loading: true,
            //Model
            coverModelVisible: false,
        };
    }

    componentWillMount() {
        this.fetchData()
    }

    fetchData() {
        var that = this;
        //获取文章数据
        axios.get('/api/articles/index')
            .then(function (response) {
                // console.log(response.data);
                that.setState({
                    articles: response.data,
                    articles_back: response.data,
                    loading: false,
                });
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    handleView(id) {
        window.open('/show/' + id)
    };

    handleDelete(id) {
        var that = this;
        confirm({
            title: '确认删除',
            content: '此操作将会永久删除此文章，确认继续？' + id,
            okText: 'Yes',
            okType: 'danger',
            cancelText: 'No',
            onOk() {
                //获取文章数据
                axios.get('/api/articles/delete/' + id)
                    .then(function (response) {
                        if (response.status == 200) {
                            that.fetchData();
                            message.success(response.data.message)
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            onCancel() {
                console.log('取消删除');
            },
        });
    }

    render() {

        const columns = [{
            title: '编号',
            dataIndex: 'id',
            key: 'id',
            width: 50,
        },
            {
                title: '封面',
                key: 'cover',
                render: (text, record) => (
                    <div>
                        <Avatar shape="square" src={record.cover || 'default.jpg'}
                                onClick={this.showCover}
                                style={{cursor: 'pointer'}}/>
                    </div>
                )
            },
            {
                title: '标题',
                key: 'title',
                render: (text, record) => (
                    <span>
                        <Link to={'/article/edit/' + record.id}>
                            {record.title}
                        </Link>
                    </span>
                ),
            },
            {
                title: '浏览量',
                dataIndex: 'view_count',
                key: 'view_count',
                width: 60
            },
            {
                title: '发表时间',
                dataIndex: 'created_at',
                key: 'created_at',
                width: 90
            },
            {
                title: '操作',
                key: 'action',
                width: 150,
                render: (text, record) => (
                    <span>
                      <ButtonGroup>
                        <Tooltip title="预览">
                          <Button icon="link"
                                  onClick={this.handleView.bind(this, record.id)}
                          />
                        </Tooltip>
                        <Tooltip title="删除">
                          <Button icon="delete"
                                  onClick={this.handleDelete.bind(this, record.id)}
                          />
                        </Tooltip>
                      </ButtonGroup>
                    </span>
                ),
            },
        ];
        return (
            <div>
                <Divider orientation="left">文 章 列 表</Divider>
                <Table size="middle"
                       dataSource={this.state.articles}
                       loading={this.state.loading}
                       columns={columns}
                       rowKey={record => record.id}
                       pagination={{pageSize: 5}}/>
            </div>
        )
    }
}