import React from "react";
import { Table, Button, Divider, message, Modal, Tooltip, Badge } from 'antd';
import {ExpandedRowRender} from "./ExpandedRowRender";

const ButtonGroup = Button.Group;
const confirm = Modal.confirm;

export class Comment extends React.Component {
    constructor() {
        super();
        this.state = {
            //评论数据
            comments:[],
            loading:true,
        };
        this.handleView = (location) =>{
            window.open(location)
        };
        this.handleDelete = (id) =>{
            var that = this;
            confirm({
                title: '确认删除',
                content: '此操作将会永久删除此评论，确认继续？',
                okText: 'Yes',
                okType: 'danger',
                cancelText: 'No',
                onOk() {
                    axios.get('z/comments/delete/' + id)
                        .then(function (response) {
                            if (response.status == 200) {
                                that.fetchData()
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
    }
    componentWillMount() {
        this.fetchData()
    }
    fetchData(){
        var that = this;
        //获取文章数据
        axios.get('z/comments')
            .then(function (response) {
                console.log(response.data);
                that.setState({
                    comments:response.data,
                    comments_back:response.data,
                    loading:false,
                })
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    render(){
        const columns = [{
            key: 'replysCount',
            render:(text, record)=>(
                <Badge count={record.replysCount} style={{ backgroundColor:'#36cbbf' }} />
            )
        },{
            title: '文章',
            dataIndex: 'article_name',
            key: 'article_name',
        },{
            title: '内容',
            dataIndex: 'content',
            key: 'content',
        },{
            title: '昵称',
            dataIndex: 'name',
            key: 'name',
        },{
            title: '邮箱',
            dataIndex: 'email',
            key: 'email',
        },{
            title: 'IP',
            dataIndex: 'ip',
            key: 'ip',
        },{
            title: '城市',
            dataIndex: 'city',
            key: 'city',
        },{
            title: '评论时间',
            dataIndex: 'created_at',
            key: 'created_at',
        },{
            title: '操作',
            key: 'action',
            width: 150,
            render: (text, record) => (
                <span>
          <ButtonGroup>
            <Tooltip title="跳转">
              <Button icon="link" onClick={this.handleView.bind(this, record.location)}/>
            </Tooltip>
            <Tooltip title="删除">
              <Button icon="delete" onClick={this.handleDelete.bind(this, record.id)}/>
            </Tooltip>
          </ButtonGroup>
        </span>
            ),
        },];
        return (
            <div>
                <Divider orientation="left">评 论 列 表</Divider>
                <Table
                    size="middle"
                    dataSource={this.state.comments}
                    loading={this.state.loading}
                    columns={columns}
                    expandedRowRender={record => <ExpandedRowRender replys={record.replys} handleDelete={this.handleDelete.bind(this)}/>}
                    pagination={{ pageSize: 5 }}/>
            </div>
        )
    }
}