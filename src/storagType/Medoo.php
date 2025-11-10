<?php
namespace App\storagType;

use App\storagType\contracts\Storage;
use Medoo\Medoo as medoolibrary;

class Medoo implements Storage
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function insert($tableName, $data): bool
    {
        $result = $this->connection->insert($tableName, $data);
        return $result->rowCount() > 0;
    }

    public function getAll($tableName): array
    {
        return $this->connection->select($tableName, "*");
    }

    public function getAllbyware($tableName, $key, $ware): array
    {
        return $this->connection->select($tableName, "*", [$key => $ware]);
    }

    public function getByFeild($tableName, $key, $ware): array
    {
        return $this->connection->select($tableName, $key, [$key => $ware]);
    }

    public function delete($tableName, $id): bool
    {
        $result = $this->connection->delete($tableName, $id);
        return $result->rowCount() > 0;
    }

    public function checkUserpassword($tableName, $username, $password): bool
    {
        $result = $this->connection->select($tableName, "password", ["username" => $username]);
        if (count($result) > 0) {
            return $result[0] == $password;
        } else {
            return false;
        }
    }


    public function getPostWithUser($tableName, $id)
    {
        return $this->connection->get(
            $tableName,
            ["[>]users" => ["user_id" => "id"]],
            [
                "posts.id",
                "posts.title",
                "posts.content",
                "posts.coverimage",
                "posts.status",
                "posts.published_at",
                "posts.created_at",
                "posts.updated_at",
                "posts.tags",
                "posts.category",
                "users.name(user_name)",
                "users.username(user_username)",
                "users.email(user_email)"
            ],
            [
                "posts.id" => $id
            ]
        );
    }

    public function getAllPostsWithDetails(): array
    {
        return $this->connection->select(
            "posts",
            [
                "[>]users" => ["user_id" => "id"],
                "[>]comments" => ["posts.id" => "post_id"],
                "[>]views" => ["posts.id" => "post_id"]
            ],
            [
                "posts.id",
                "posts.title",
                "posts.content",
                "posts.coverimage",
                "posts.status",
                "posts.published_at",
                "posts.created_at",
                "posts.updated_at",
                "posts.tags",
                "posts.category",

                "users.name(user_name)",
                "users.username(user_username)",
                "users.email(user_email)",

                "comments.id(comment_id)",
                "comments.user_id(comment_user_id)",
                "comments.content(comment_content)",
                "comments.created_at(comment_created_at)",

                "views.id(view_id)",
                "views.view_count(total_views)"
            ]
        );
    }


   public function getUserTotals($userId): array
{
    $user = $this->connection->get("users", [
        "id(user_id)",
        "name(user_name)",
        "username(user_username)"
    ], [
        "id" => $userId
    ]);

    if (!$user) {
        return [];
    }

    $totalPosts = $this->connection->count("posts", [
        "user_id" => $userId
    ]);

    $totalComments = $this->connection->count("comments", [
        "user_id" => $userId
    ]);

    $totalLikes = $this->connection->count("likes", [
        "user_id" => $userId
    ]);

    $user['total_posts'] = $totalPosts;
    $user['total_comments'] = $totalComments;
    $user['total_likes'] = $totalLikes;

    return $user;
}



}
