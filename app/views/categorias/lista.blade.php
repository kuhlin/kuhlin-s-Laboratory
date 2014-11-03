<?php
/* ~~~~~~ file info ~~~~~~
 * Author:	George-Iulian, Diaconu
 * Create date: 03-nov-2014
 * Modifs:	
 * Description: 
 * Used in:	
  ~~~~~~ file info ~~~~~~ */
?>


<link rel="stylesheet" href="./../css/bootstrap.min.css" />
<link rel="stylesheet" href="./../css/plugins/dataTables.bootstrap.css" />
<link rel="stylesheet" href="./../css/plugins/jsTree/default/style.min.css" />
<style>
    html, body { background:#ebebeb; font-size:10px; font-family:Verdana; margin:0; padding:0; }
    #container { min-width:320px; margin:0px auto 0 auto; background:white; border-radius:0px; padding:0px; overflow:hidden; }
    #tree { float:left; min-width:319px; border-right:1px solid silver; overflow:auto; padding:0px 0; }
    #data { margin-left:320px; }
    #data textarea { margin:0; padding:0; height:100%; width:100%; border:0; background:white; display:block; line-height:18px; }
    #data, #code { font: normal normal normal 12px/18px 'Consolas', monospace !important; }
</style>
<div id="container" role="main">
    <div id="tree"></div>
    <div id="data">
        <div class="content code" style="display:none;"><textarea id="code" readonly="readonly"></textarea></div>
        <div class="content folder" style="display:none;"></div>
        <div class="content image" style="display:none; position:relative;"><img src="" alt="" style="display:block; position:absolute; left:50%; top:50%; padding:0; max-height:90%; max-width:90%;" /></div>
        <div class="content default" style="text-align:center;">Select a node from the tree.</div>
    </div>
</div>

<script src="./../js/jquery-1.11.0.js"></script>
<script src="./../js/bootstrap.min.js"></script>
<script src="./../js/plugins/metisMenu/metisMenu.js"></script>
<script src="./../js/sb-admin-2.js"></script>
<script src="../../js/plugins/jsTree/jstree.js"></script>

<script>
    $(function () {
        $(window).resize(function () {
            var h = Math.max($(window).height() - 0, 420);
            $('#container, #data, #tree, #data .content').height(h).filter('.default').css('lineHeight', h + 'px');
        }).resize();

        $('#tree')
                .jstree({
                    'core': {
                        'data': {
                            'url': 'catoperation/get_node',
                            'data': function (node) {
                                return {'id': node.id};
                            }
                        },
                        'check_callback': true,
                        'themes': {
                            'responsive': false
                        }
                    },
                    'plugins': ['state', 'dnd', 'contextmenu', 'wholerow']
                })
                .on('delete_node.jstree', function (e, data) {
                    $.get('?operation=delete_node', {'id': data.node.id})
                            .fail(function () {
                                data.instance.refresh();
                            });
                })
                .on('create_node.jstree', function (e, data) {
                    $.get('catoperation/get_node', {'id': data.node.parent, 'position': data.position, 'text': data.node.text})
                            .done(function (d) {
                                data.instance.set_id(data.node, d.id);
                            })
                            .fail(function () {
                                data.instance.refresh();
                            });
                })
                .on('rename_node.jstree', function (e, data) {
                    $.get('?operation=rename_node', {'id': data.node.id, 'text': data.text})
                            .fail(function () {
                                data.instance.refresh();
                            });
                })
                .on('move_node.jstree', function (e, data) {
                    $.get('?operation=move_node', {'id': data.node.id, 'parent': data.parent, 'position': data.position})
                            .fail(function () {
                                data.instance.refresh();
                            });
                })
                .on('copy_node.jstree', function (e, data) {
                    $.get('?operation=copy_node', {'id': data.original.id, 'parent': data.parent, 'position': data.position})
                            .always(function () {
                                data.instance.refresh();
                            });
                })
                .on('changed.jstree', function (e, data) {
                    if (data && data.selected && data.selected.length) {
                        $.get('?operation=get_content&id=' + data.selected.join(':'), function (d) {
                            $('#data .default').html(d.content).show();
                        });
                    }
                    else {
                        $('#data .content').hide();
                        $('#data .default').html('Select a file from the tree.').show();
                    }
                });
    });

</script>
