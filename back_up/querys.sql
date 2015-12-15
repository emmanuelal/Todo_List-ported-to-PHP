select users.email 
from users ,TodoLists ,todolist_items 
where users.todo_list_id = TodoLists.todo_list_id 
and TodoLists.item_id = todolist_items.item_id;




CREATE TABLE `todolist_items` (
  `i_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `completed` varchar(6) DEFAULT 'false',
  PRIMARY KEY (`i_id`,`item_id`)
) ENGINE=InnoDB;

CREATE TABLE `TodoLists` (
  `t_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TodoList_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `todo_list_id` int(11) NOT NULL,
  PRIMARY KEY (`t_id`,`todo_list_id`)
) ENGINE=InnoDB; 

// get items from todo_list_id

se 