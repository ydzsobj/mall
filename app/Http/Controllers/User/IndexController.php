<?php

namespace App\Http\Controllers\User;

use App\Models\AdminConfig;
use App\Models\Good;
use App\Models\GoodCategory;
use App\Models\GoodModule;
use App\Models\Slide;
use Encore\Admin\Config\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class IndexController extends Controller
{

    /**
     * @api {get} /api/user/index  1.5 首页
     * @apiName index
     * @apiGroup User
     *
     * @apiParam {Number} country_id 国家地区id
     *
     * @apiSuccess {Array} category 分类
     * @apiSuccess {Array} slides 轮播
     * @apiSuccess {Array} floorData 展示模块
     * @apiSuccess {Array} hotGoods 热卖
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     * {
     *    "success": true,
     *    "msg": "",
     *    "data": {
     *        "category": [
     *   {
    *                "mallCategoryId": 18,
    *                "mallCategoryName": "模块1",
    *                "image_url": "",
    *                "image_url_list": [
    *                    "http://192.168.1.132:8083/uploads/admin/images/4c89b06e21cc4a7dde6f93576278d36e.png",
    *                    "http://192.168.1.132:8083/uploads/admin/images/0255e27fc9d441501417d765fa84cfdf.png",
    *                    "http://192.168.1.132:8083/uploads/admin/images/e8d1d194e0bde1fb24d7e30a105c98e1.png"
    *                ],
    *                "desc": "这是描述。。。。。。。。"
    *         },
     *            {
     *                "mallCategoryId": 2,
     *                "mallCategoryName": "美妆"
     *                "image_url": "http://192.168.1.132:8081/uploads/admin/images/47a2e200a6eb3b83e27695587e263856.jpeg"
     *            },
     *            {
     *                "mallCategoryId": 3,
     *                "mallCategoryName": "电子商品"
     *            }
     *        ],
     *        "slides": [
     *            {
     *                "good_id": 48
     *                "slide_id": 4,
     *                "image": "http://192.168.1.132:8081/storage/uploads/image/2019/08/10/f4799862d9401afa6e6fbfbfcd5a5b50.png"
     *            },
     *            {
     *                "good_id": 48
     *                "slide_id": 3,
     *                "image": "http://192.168.1.132:8081/storage/uploads/image/2019/08/10/ea3c55fe710f506c72797b8f36452a5d.png"
     *            }
     *        ],
     *        "hotGoods": [
     *
     *                {
     *                    "goodsId": 48,
     *                    "name": "测试-无规格",
     *                    "mallPrice": "899.88",
     *                    "price": "88.99",
     *                    "good_module_id": 2,
     *                    "image": "http://192.168.1.133:8081/storage/uploads/image/2019/08/08/03b5ed3f0111edeeaa393c075c0d34f4.png"
     *                },
     *                {
     *                    "goodsId": 46,
     *                    "name": "测试-只有颜色",
     *                    "mallPrice": "88.00",
     *                    "price": "66.00",
     *                    "good_module_id": 2,
     *                    "image": "http://192.168.1.133:8081/storage/uploads/image/2019/08/08/dade22db327cb7fa9a44506934bba5c0.png"
     *                },
     *                {
     *                    "goodsId": 45,
     *                    "name": "测试0807",
     *                    "mallPrice": "999.00",
     *                    "price": "888.00",
     *                    "good_module_id": 2,
     *                    "image": "http://192.168.1.133:8081/storage/uploads/image/2019/08/08/c10410f41dcf17266e42e9a1de5cd262.png"
     *                },
     *                {
     *                    "goodsId": 44,
     *                    "name": "测试0807",
     *                    "mallPrice": "999.00",
     *                    "price": "888.00",
     *                    "good_module_id": 2,
     *                    "image": "http://192.168.1.133:8081/storage/uploads/image/2019/08/08/0ca6091f438822002b53a6a29617e078.png"
     *                },
     *                {
     *                    "goodsId": 43,
     *                    "name": "122222",
     *                    "mallPrice": "111.00",
     *                    "price": "111.00",
     *                    "good_module_id": 2,
     *                    "image": "http://192.168.1.133:8081/storage/uploads/image/2019/08/07/8e599aec96ca117adb8f0227047819e1.png"
     *                },
     *                {
     *                    "goodsId": 34,
     *                    "name": "测试-0806",
     *                    "mallPrice": "999.00",
     *                    "price": "888.00",
     *                    "good_module_id": 2,
     *                    "image": "http://192.168.1.133:8081/storage/uploads/image/2019/08/06/9dbf56e90884418049b3ef16a2acbc6e.png"
     *                }
     *
     *        ],
     *        "floorData": [
     *            {
     *                "floor": [
     *                    {
     *                        "good_module_id": 3,
     *                        "image": "http://192.168.1.132:8081/storage/uploads/image/2019/08/09/216cc73b23bcda62c1bfcfd192a8cfc8.png"
     *                    },
     *                    {
     *                        "good_module_id": 2,
     *                        "image": "http://192.168.1.132:8081/storage/uploads/image/2019/08/10/8e0eaadb89fb3f44e8e54f7922fa07d7.png"
     *                    },
     *                    {
     *                        "good_module_id": 1,
     *                        "image": "http://192.168.1.132:8081/storage/uploads/image/2019/08/10/ca116abf595b0357607d262924f3068c.png"
     *                    }
     *                ],
     *                "name": ""
     *            }
     *        ],
     *
     *   "country": {
        *            "id": 1,
        *            "name": "印尼",
        *            "money_sign": "IDR",
        *            "global_lang": "ind-BA",
        *            "global_email": "t78933934@gmail.com",
        *            "global_phone": "18811112222",
        *            "global_address": "河南郑州金水区",
        *            "global_title": "印尼测试标题",
        *            "global_keywords": "鞋子，包",
        *            "global_description": "这是一条描述",
        *            "order_prefix": "CR",
        *            "sms_msg": "暂时忽略",
        *            "logo_url": "http://192.168.1.132:8083/uploads/admin/images/02.png",
        *            "video_url": "http://192.168.1.132:8083/uploads/admin/files/demo.mp4",
        *            "foreign_link": "http://baidu.com",
        *            "created_at": "2019-12-18 16:16:12",
        *            "updated_at": "2019-12-20 10:48:01"
        *        }
     *    }
     *}
     *
     */
    public function index(Request $request)
    {

        $country_id = $request->get('country_id');

        $country = Country::find($country_id);

        //分类
        $category = GoodCategory::select(
            'id as mallCategoryId',
            'show_name as mallCategoryName',
            'image_url',
            'image_url_list',
            'desc'
        )
            ->where('country_id', $country_id)
            ->orderBy('sort', 'desc')
            ->get();

        //轮播图
        $slides = Slide::select('id as slide_id','image_url as image','good_id')
            ->where('country_id', $country_id)
            ->orderBy('sort','desc')
            ->get();

        //获取模块
        $good_modules = GoodModule::with(['good_module_images' => function($query){
            $query->select(
                'good_id as goodsId',
                'image_url as image',
                'good_module_id');
        }])->select(
            'good_modules.id',
            'good_modules.show_name as name'
        )
            ->orderBy('good_modules.sort', 'desc')
            ->get();

        $floorData = collect([]);
        foreach ($good_modules as $good_module){

            $floorData->push(['floor' => $good_module->good_module_images, 'name' => $good_module->name]);
        }

        $hotGoods = collect([]);

        $gd = new Good();

        $goods = $gd->user_good_data($request->all());

        $hotGoods = $goods->all();

        return returned(true, '', compact('category', 'slides','hotGoods','floorData', 'country'));

    }


    /**
     * @api {get} /api/user/configs  1.6 基础配置
     * @apiName config
     * @apiGroup User
     *
     *
     * @apiSuccess {string} area 地区
     * @apiSuccess {string} lang 语言
     * @apiSuccess {string} money_sign 货币符号
     * @apiSuccess {string} email 展示邮箱
     *
     * @apiSuccessExample Success-Response:
     * HTTP/1.1 200 OK
     *{
     *    "success": true,
     *    "msg": "",
     *    "data": {
     *        "config": {
     *            "area": "中国台湾",
     *            "lang": "zh_CN",
     *            "money_sign": "$",
     *            "email": "123@qq.com"
     *        },
     *      "global_configs": {
     *          "money_sign": "$",
     *          "global_area": "印度尼西亚",
     *          "global_lang": "en-US",
     *          "global_email": "123@qq.com",
     *          "global_phone": "18811112222"
     *      }
     *    }
     *}
     */
    public function config(Request $request){

        $country_all = Country::all();

        $country_list = collect([]);

        $country_all->map(function($item) use ($country_list){
            $country_list->put($item->id, $item->toArray());
        });

        return returned(true, '', compact('country_list'));
    }





}
