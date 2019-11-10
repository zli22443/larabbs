<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'http://larabbs.cc/uploads/images/avatars/201911/10/6_1573371909_p6I2UM4SA5.jpg',
            'http://larabbs.cc/uploads/images/avatars/201911/10/6_1573371909_p6I2UM4SA5.jpg',
            'http://larabbs.cc/uploads/images/avatars/201911/10/7_1573372219_Us76XIE0jE.png',
            'http://larabbs.cc/uploads/images/avatars/201911/10/7_1573372219_Us76XIE0jE.png',
            'http://larabbs.cc/uploads/images/avatars/201911/10/7_1573372219_Us76XIE0jE.png',
            'http://larabbs.cc/uploads/images/avatars/201911/10/6_1573371909_p6I2UM4SA5.jpg'
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(20)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'JackZhi';
        $user->email = '3477107094@qq.com';
        $user->avatar = 'http://larabbs.cc/uploads/images/avatars/201911/10/6_1573371909_p6I2UM4SA5.jpg';
        $user->save();
    }
}
