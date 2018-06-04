<?php
/**
 * Created by PhpStorm.
 * User: 時間在說謊
 * Date: 2018/5/17
 * Time: 16:16
 */

namespace app\admin\controller;

use think\Config;
use think\Controller;

class Admin extends Controller
{
    /**
     * 首页信息
     * Created by liuHW
     * Date 2018/6/2
     */
    public function home()
    {
        // 左侧导航信息
        $result= $this->left_info();
        // 用户拥有的权限
        $id = '1';
        $rule = $this->access_info($id);

        $this->assign('list',$result);
        $this->assign('auth',$rule);
        return view();
    }

    /**
     * 所有管理组
     * Created by liuHW
     * Date 2018/6/2
     */
    public function modify()
    {
        $where['status'] = 0;
        $arr = db('admin_group')->where($where)->select();

        $this->assign('list', $arr);
        return view();
    }

     /**
      * 左侧导航的信息
      * @access private
      * @return array
      * Created by liuHW
      * Date 2018/6/2
      */
    private function left_info()
    {
        $where_first['level'] = 1;
        $result['first_arr'] = db('admin_auth_rule')->where($where_first)->select();
        foreach ($result['first_arr'] as &$item) {
            $where_second['level'] = 2;
            $where_second['parent_id'] = $item['id'];
            $item['second_arr'] = db('admin_auth_rule')->where($where_second)->select();
            foreach ($item['second_arr'] as &$value) {
                $where_third['level'] = 3;
                $where_third['parent_id'] = $value['id'];
                $value['third_arr'] = db('admin_auth_rule')->where($where_third)->select();
            }
        }

        return $result;
    }

    /**
     * 查询分组
     * @access private
     * @param mixed id 用户ID
     * @return string
     * Created by liuHW
     * Date 2018/6/4
     */
    private function access_info($id)
    {
        // 用户分组
        $where_access['uid'] = $id;
        $info = db('admin_group_access')->where($where_access)->find();

        return $this->user_rule($info['group_id']);
    }
    /**
     * 用户组拥有的权限
     * @access private
     * @param mixed group_id 用户分组ID
     * @return string
     * Created by liuHW
     * Date 2018/6/2
     */
    private function user_rule($group_id)
    {
        // 分组的权限
        $where_group['group_id'] = $group_id;
        $find = db('admin_group')->where($where_group)->find();
        $rule = explode(',', $find['rules']);

        return $rule;
    }

    /**
     * 修改权限
     * @access public
     * @param mixed id 用户id
     * Created by liuHW
     * Date 2018/6/2
     */
    public function rule($group_id)
    {
        // 左侧导航信息
        $result= $this->left_info();
        // 用户拥有的权限
        $rule = $this->user_rule($group_id);

        $this->assign('rule', $rule);
        $this->assign('list', $result);
        $this->assign('group_id', $group_id);
        return view();
    }

    /**
     * 修改权限
     * Created by liuHW
     * Date 2018/6/4
     */
    public function get_rule()
    {
        $post_arr = request()->post();
        // 当前用户组的权限
        $rule = $this->user_rule($post_arr['group_id']);
        // 修改后的权限
        $rules = $post_arr['id'];
        // 比较数组
        $value1 = array_diff($rules, $rule);
        $value2 = array_diff($rule, $rules);
        if (empty($value1) && empty($value2)) {
            exit("<script>alert('未更改权限');window.history.go(-1);</script>");
        }
        else {
            sort($rules);
            $data['rules'] = implode(',', $rules);
            $where_group['group_id'] = $post_arr['group_id'];
            $result = db('admin_group')->where($where_group)->update($data);
            if ($result) {
                exit("<script>alert('修改成功');window.location.href='home'</script>");
            }
            else {
                exit("<script>alert('修改失败');window.history.go(-1);</script>");
            }
        }
    }

    /**
     * 错误页面
     * @access public
     * Created by liuHW
     * Date 2018/6/2
     */
    public function nofind()
    {
        return view();
    }
}