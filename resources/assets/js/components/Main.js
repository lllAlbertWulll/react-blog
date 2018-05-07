import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {
    HashRouter as Router,
    Route,
    Link
} from 'react-router-dom';
import {Layout, Menu, Icon, Dropdown, Avatar, message} from 'antd';
import {Dashboard} from './Dashboard/Dashboard';
import {Article} from './Article/Acticle';
import {ArticleCreate} from './Article/ActicleCreate';
import {ArticleEdit} from './Article/ActicleEdit';
import {ArticleTrash} from './Article/ActicleTrash';
import {Comment} from './Comment/Comment';
import {CommentTrash} from './Comment/CommentTrash';
import {Tag} from './Tag/Tag';
import {TagTrash} from './Tag/TagTrash';

require('./Main.css');

const {Header, Content, Footer, Sider} = Layout;
const SubMenu = Menu.SubMenu;

const avatarOnClick = function ({ key }) {
    switch (key) {
        case 'logout':
            message.info(`TODO 退出登录`);
            //TODO 退出登录
            break;
        default:
            break;
    }
};

const menu = (
    <Menu onClick={avatarOnClick}>
        <Menu.Divider />
        <Menu.Item key="logout">
            <Icon type="logout" /> 退出登录
        </Menu.Item>
    </Menu>
);

class Main extends React.Component {
    constructor(props) {
        super(props);
        this.rootSubmenuKeys = ['home', 'article', 'comment', 'tag'];
        this.state = {
            collapsed: false,
            openKeys: ['home']
        };
        this.toggle = () => {
            this.setState({
                collapsed: !this.state.collapsed,
            });
        };
        this.onOpenChange = (openKeys) => {
            const latestOpenKey = openKeys.find(key => this.state.openKeys.indexOf(key) === -1);
            if (this.rootSubmenuKeys.indexOf(latestOpenKey) === -1) {
                this.setState({ openKeys });
            } else {
                this.setState({
                    openKeys: latestOpenKey ? [latestOpenKey] : [],
                });
            }
        }
    }

    render() {
        return (
            <Router>
                <Layout className="sider-layout">
                    <Sider
                        trigger={null}
                        collapsible
                        collapsed={this.state.collapsed}
                    >
                        <div className="logo"/>
                        <Menu theme="dark"
                              mode="inline"
                              openKeys={this.state.openKeys}
                              onOpenChange={this.onOpenChange}
                        >
                            <Menu.Item key="home">
                                <Link to="/">
                                    <Icon type="dashboard"/>
                                    <span>后台首页</span>
                                </Link>
                            </Menu.Item>
                            <SubMenu
                                key="article"
                                title={<span><Icon type="book" /><span>文章管理</span></span>}
                            >
                                <Menu.Item key="1">
                                    <Link to="/article">
                                        <span>文章列表</span>
                                    </Link>
                                </Menu.Item>
                                <Menu.Item key="2">
                                    <Link to="/article/create">
                                        <span>写新文章</span>
                                    </Link>
                                </Menu.Item>
                                <Menu.Item key="3">
                                    <Link to="/article/trash">
                                        <span>文章废纸篓</span>
                                    </Link>
                                </Menu.Item>
                            </SubMenu>
                            <SubMenu
                                key="comment"
                                title={<span><Icon type="message" /><span>评论管理</span></span>}
                            >
                                <Menu.Item key="4">
                                    <Link to="/comment">
                                        <span>评论列表</span>
                                    </Link>
                                </Menu.Item>
                                <Menu.Item key="5">
                                    <Link to="/comment/trash">
                                        <span>评论废纸篓</span>
                                    </Link>
                                </Menu.Item>
                            </SubMenu>
                            <SubMenu
                                key="tag"
                                title={<span><Icon type="tags" /><span>标签管理</span></span>}
                            >
                                <Menu.Item key="6">
                                    <Link to="/tag">
                                        <span>标签列表</span>
                                    </Link>
                                </Menu.Item>
                                <Menu.Item key="7">
                                    <Link to="/tag/trash">
                                        <span>标签废纸篓</span>
                                    </Link>
                                </Menu.Item>
                            </SubMenu>
                        </Menu>
                    </Sider>
                    <Layout>
                        <Header style={{background: '#fff', padding: 0}}>
                            <Icon
                                className="trigger"
                                type={this.state.collapsed ? 'menu-unfold' : 'menu-fold'}
                                onClick={this.toggle}
                            />
                            <div style={{ float:'right', height:'100%', padding: '0 20px' }}>
                                <Dropdown overlay={menu} trigger={['click']}>
                                    <a className="ant-dropdown-link" href="#">
                                        <Avatar icon="user" style={{ verticalAlign: 'middle' }}/>
                                    </a>
                                </Dropdown>
                            </div>
                        </Header>
                        <Content style={{ margin: '24px 16px', padding: 24, background: '#fff' }}>
                            <Route path="/" exact component={Dashboard}/>
                            <Route path="/article" exact component={Article}/>
                            <Route path="/article/create" exact component={ArticleCreate}/>
                            <Route path="/article/edit/:id" exact component={ArticleEdit}/>
                            <Route path="/article/trash" exact component={ArticleTrash}/>
                            <Route path="/comment" exact component={Comment}/>
                            <Route path="/comment/trash" exact component={CommentTrash}/>
                            <Route path="/tag" exact component={Tag}/>
                            <Route path="/tag/trash" exact component={TagTrash}/>
                        </Content>
                        <Footer style={{textAlign: 'center'}}>
                            Ant Design ©2016 Created by Ant UED
                        </Footer>
                    </Layout>
                </Layout>
            </Router>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(
        <Main/>,
        document.getElementById('root')
    );
}
