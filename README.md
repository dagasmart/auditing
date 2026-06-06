# Auditing
自动记录模型数据变更的审计包


### 这个包能帮咱干啥
‌自动记录数据变化‌：模型创建、更新、删除、恢复操作都会自动存到 audits 表里，不用手动写监听器 。
‌完整操作追溯‌：每条记录包含旧值、新值、操作用户 ID、IP 地址、User Agent、URL 等上下文信息 。
‌灵活控制审计范围‌：
#### 可以用$auditInclude 指定只审计哪些字段，或用$auditExclude排除敏感字段如密码 。
‌多模型统一存储‌：一个 audits 表通过多态关联能记录所有模型的变更，查询和管理都方便 。‌‌‌
怎么快速装好用起来
#### Composer 安装‌：运行
#### composer require dagasmart/auditing
#### 注意包名拼写准确，dagasmart作者组织名
#### 发布迁移文件‌：执行
```dotenv
php artisan vendor:publish --provider="DagaSmart\Auditing\AuditingServiceProvider" --tag="migrations"
```
#### 生成审计表迁移文件，‌运行数据库迁移‌：执行
```dotenv
php artisan migrate
```
#### 创建 audits 表，不跑这步会报错表不存在 。
#### 模型启用审计‌：在需要审计的模型里 use Auditable trait 并实现 AuditableContract 接口，两个缺一不可 。
Laravel model
```dotenv
use DagaSmart\Auditing\Contracts\Auditable as AuditableContract;
use DagaSmart\Auditing\Auditable;
class User extends Model implements AuditableContract
{
    use Auditable;
}
```
哪些 Laravel 版本能配合‌：支持 Laravel 11.x 到 13.x，PHP 8.3 以上，当前活跃维护中 。

