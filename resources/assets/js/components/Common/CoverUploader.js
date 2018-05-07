import React from "react";
import { Icon, Button, Upload } from 'antd';

export class CoverUploader extends React.Component {
    render() {
        const props = {
            action: '/api/upload/cover',
            listType: 'picture',
            defaultFileList: [...this.props.coverList],
            headers:{
                'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content
            }
        };
        return (
            <div>
                <Upload {...props} onChange={this.props.coverChanged}>
                    <Button>
                        <Icon type="upload" /> 点此上传
                    </Button>
                </Upload>
            </div>
        )
    }
}