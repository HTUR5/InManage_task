<h1> create a user </h1> 

<form name="create_user" method="post" action="admin_func.php">

    <div>
        <label for="user_name">User name:</label>
        <input name="user_name" id="user_name" required>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div>
        <label for="active">Active:</label>
        <select name="active" id="active" required>
            <option value="yes">True</option>
            <option value="no">False</option>
        </select>    
    </div>

    <div>
        <label for="birthday">Birthday date:</label>
        <input type="date" name="birthday" id="birthday" required>
    </div>

    <div>
    <input type="submit" name="create_user" value="create user" />
    </div>

</form>

<h1> update a user </h1> 

<form name="update_user" method="post" action="admin_func.php">

    <div>
        <label for="user_id">Enter user id:</label>
        <input type="number" name="user_id" id="user_id" step="1" required>
    </div>

    <div>
        <label for="update_user_name">User name:</label>
        <input name="update_user_name" id="update_user_name">
    </div>

    <div>
        <label for="update_email">Email</label>
        <input type="email" name="update_email" id="update_email">
    </div>

    <div>
        <label for="update_active">Active:</label>
        <select name="update_active" id="update_active">
            <option value="yes">True</option>
            <option value="no">False</option>
        </select>    
    </div>

    <div>
        <label for="update_birthday">Birthday date:</label>
        <input type="date" name="update_birthday" id="update_birthday">
    </div>

    <div>
    <input type="submit" name="update_user" value="update user" />
    </div>
</form>

<h1> delete a user </h1> 

<form name="delete_user" method="post" action="admin_func.php">

    <div>
        <label for="delete_user_id">Enter user id:</label>
        <input type="number" name="delete_user_id" id="delete_user_id" step="1" required>
    </div>

    <div>
    <input type="submit" name="delete_user" value="delete user" />
    </div>

</form>

<h1> create a post </h1> 

<form name="create_post" method="post" action="admin_func.php">
    
    <div>
        <label for="post_user_id">Enter an integer for user id:</label>
        <input type="number" name="post_user_id" id="post_user_id" step="1" required>
    </div>

    <div>
        <label for="title">title</label>
        <input name="title" id="title" required>
    </div>
    
    <div>
        <label for="content">Content</label>
        <textarea name="content" rows="4" cols="40" id="content" required></textarea>
    </div>

    <div>
        <label for="active">Active:</label>
        <select name="active" id="active" required>
            <option value="yes">True</option>
            <option value="no">False</option>
        </select>    
    </div>

    <div>
        <label for="creation_date">Publication date and time</label>
        <input type="datetime-local" name="creation_date" id="creation_date" value="<?php echo date('Y-m-d\TH:i'); ?>">
    </div>

    <div>
    <input type="submit" name="create_post" value="create post" />
    </div>

</form>

<h1> update a post </h1> 

<form name="update_post" method="post" action="admin_func.php">
    <div>
        <label for="post_id">Enter post id:</label>
        <input type="number" name="post_id" id="post_id" step="1" required>
    </div>

    <div>
        <label for="user_id">user id:</label>
        <input type="number" name="user_id" id="user_id" step="1">
    </div>

    <div>
        <label for="title">title</label>
        <input name="title" id="title" >
    </div>
    
    <div>
        <label for="content">Content</label>
        <textarea name="content" rows="4" cols="40" id="content"></textarea>
    </div>

    <div>
        <label for="active">Active:</label>
        <select name="active" id="active">
            <option value="yes">True</option>
            <option value="no">False</option>
        </select>    
    </div>
    
    <div>
        <label for="creation_date">Publication date and time</label>
        <input type="datetime-local" name="creation_date" id="creation_date" value="<?php echo date('Y-m-d\TH:i'); ?>">
    </div>

    <div>
    <input type="submit" name="update_post" value="update post" />
    </div>
</form>

<h1> delete a post </h1> 

<form name="delete_post" method="post" action="admin_func.php">

    <div>
        <label for="delete_post_id">Enter post id:</label>
        <input type="number" name="delete_post_id" id="delete_post_id" step="1" required>
    </div>

    <div>
    <input type="submit" name="delete_post" value="delete post" />
    </div>

</form>



