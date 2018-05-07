import React from "react";
import { Link } from 'react-router-dom';
import { Table, Input, Button, Icon, Divider, message, Modal, Tooltip, Badge, Avatar } from 'antd';
const ButtonGroup = Button.Group;
const confirm = Modal.confirm;



export class ArticleTrash extends React.Component {
    constructor() {
        super();
        this.state = {
            //文章数据
            articles:[],
            articles_back:[],
            loading:false,
            //标题搜索
            filterDropdownVisible: false,
            searchText: '',
            filtered: false,
            //Model
            coverModelVisible: false,
        };
        this.showCover = () =>{
            this.setState({
                coverModelVisible: true,
            });
        };
        this.handleCancelCoverModel = () =>{
            this.setState({
                coverModelVisible: false,
            });
        }
    }
    componentWillMount() {
        //this.fetchData()
    }
    fetchData(){
        var that = this;
        //获取文章数据
        axios.get('z/articles')
            .then(function (response) {
                //console.log(response.data);
                that.setState({
                    articles:response.data,
                    articles_back:response.data,
                    loading:false,
                })
            })
            .catch(function (error) {
                console.log(error);
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
                        <Avatar shape="square" src={record.cover || 'default.jpg'} onClick={this.showCover}
                                style={{cursor: 'pointer'}}/>
                        <Modal
                            title="封面图片"
                            visible={this.state.coverModelVisible}
                            onCancel={this.handleCancelCoverModel}
                            footer={null}
                            width="80%"
                            style={{textAlign: 'center'}}
                        >
                            <img src={record.cover || 'default.jpg'} style={{maxWidth: '100%'}}/>
                        </Modal>
                    </div>
                )
            },
            {
                title: '标题',
                key: 'title',
                render: (text, record) => (
                    <span>
                        <Link to={'/articles/show/' + record.id}>
                          {record.title}
                        </Link>
                    </span>
                ),
            },
            {
                title: '内容',
                dataIndex: 'content',
                key: 'content',
            },
            {
                title: '状态',
                key: 'is_hidden',
                width: 80,
                render: (text, record) => {
                    if (record.is_hidden)
                        return <Badge status="warning" text="笔记"/>
                    else
                        return <Badge status="processing" text="已发表"/>
                }
            },
            {
                title: '浏览量',
                dataIndex: 'view',
                key: 'view',
                width: 60
            },
            {
                title: '最后访问',
                dataIndex: 'updated_at_diff',
                key: 'updated_at',
                width: 80
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
              <Button icon="link" onClick={this.handleView.bind(this, record.id)}/>
            </Tooltip>
            <Tooltip title="发表">
              <Button icon="book" onClick={this.handlePublish.bind(this, record.id)}/>
            </Tooltip>
            <Tooltip title="置顶">
              <Button icon={record.is_top ? "up-square" : "up-square-o"}
                      onClick={this.handleTop.bind(this, record.id)}/>
            </Tooltip>
            <Tooltip title="删除">
              <Button icon="delete" onClick={this.handleDelete.bind(this, record.id)}/>
            </Tooltip>
          </ButtonGroup>
        </span>
                ),
            },
        ];
        return (
            <div>
                <Divider orientation="left">文 章 废 纸 篓</Divider>
                <Table size="middle" dataSource={this.state.articles} loading={this.state.loading} columns={columns}
                       pagination={{pageSize: 5}}/>
            </div>
        )
    }
}