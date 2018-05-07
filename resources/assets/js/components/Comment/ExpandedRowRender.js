import React from "react";
import { Table, Button } from 'antd';

export class ExpandedRowRender extends React.Component {
    constructor(props) {
        super();
        this.state = {
        };
    }
    render(){
        const columns = [
            { title: '内容', dataIndex: 'content', key: 'content' },
            { title: '昵称', dataIndex: 'name', key: 'name' },
            { title: '邮箱', dataIndex: 'email', key: 'eamil' },
            { title: 'IP', dataIndex: 'ip', key: 'ip' },
            { title: '城市', dataIndex: 'city', key: 'city' },
            { title: '评论时间', dataIndex: 'created_at', key: 'created_at' },
            {
                title: '操作',
                key: 'action',
                render: (text, record) => (
                    <span>
                        <Button type="default" size="small" icon="delete" onClick={this.props.handleDelete.bind(this, record.id)}/>
                    </span>
                ),
            },
        ];
        const data = [];
        for (let i = 0; i < 3; ++i) {
            data.push({
                key: i,
                date: '2014-12-24 23:12:00',
                name: 'This is production name',
                upgradeNum: 'Upgraded: 56',
            });
        }
        return (
            <Table
                columns={columns}
                dataSource={this.props.replys}
                pagination={false}
            />
        );
    }
}