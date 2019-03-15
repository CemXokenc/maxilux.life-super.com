.table_sorter {
    display: inline-block;
    position: relative;
    color: #000000;
}
.table_sorter.active {
    color: #555555;
}

.table_sorter.active:after {
    color: #555555;
    display: block;
    position: absolute;
    width: 13px;
    height: 14px;
    right: -15px;
    top: 1px;
    line-height: 15px;
    font-size: 14px;
}
.table_sorter.active.down:after {
    content: "▲";
}
.table_sorter.active.up:after {
    content: "▼";
}

.order_comment_item {
    display: block;
    position: relative;
    cursor: pointer;
    content: " ";
    min-height: 53px;
    width: 200px;
    padding: 4px;
    margin: 0;
}
#order_status_editer {
    display: block;
    position: absolute;
    top: -18px;
    left: -18px;
    width: 252px;
    background-color: #EEF5CC;
    min-height: 79px;
    padding: 5px;
    border: 1px #D0D7AE solid;
    border-radius: 7px;
    z-index: 1;
}

#order_status_editer .comment_body {
    width: 100%;
}
#order_status_editer .labels_block {
    display: block;
    position: relative;
    width: 100%;
    height: 20px;
}
#order_status_editer .labels_block .comment_label_element {
    display: inline-block;
    position: relative;
    content: " ";
    height: 17px;
    cursor: pointer;
}
#order_status_editer .labels_block .comment_label_element.active {
    border: 1px #777 solid;
}
#order_status_editer .labels_block .comment_label_element:hover {
    border: 1px #8a8 solid;
}
#order_status_editer .button {
    display: block;
    position: relative;
    width: 100%;
    text-align: center;
    margin-top: 2px;
    cursor: pointer;
}
#order_status_editer .save {
    background-color: rgba(102, 153, 102, 0.43);
}
#order_status_editer .save:hover {
    background-color: rgba(102, 199, 102, 0.43);
}
#order_status_editer .cancel {
    background-color: rgba(153, 102, 102, 0.43);
}
#order_status_editer .cancel:hover {
    background-color: rgba(199, 102, 102, 0.43);
}
.reset_filter {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}