<?php
require_once("lib.inc.php");

$GLOBAL_SESSION=returnsession();
	require_once("systemprivateinc.php");

	CheckSystemPrivate("���ڹ���-�̶��ʲ�-������ϸ");



if($_GET['action']=="add_default_data")		{
	page_css('�黹');
	$�ʲ���� = $_POST['�ʲ����'];
	$�ʲ����� = $_POST['�ʲ�����'];
	$������������ = $_POST['������������'];
	if($������������!=""&&$_POST['��׼��']!="")	{
		$_POST['����'] = returntablefield("fixedasset","�ʲ����",$�ʲ����,"����");
		$_POST['����'] = returntablefield("fixedasset","�ʲ����",$�ʲ����,"����");
		$_POST['���'] = returntablefield("fixedasset","�ʲ����",$�ʲ����,"���");
		$sql = "update fixedasset set ��������='$������������' where �ʲ����='$�ʲ����'";
		$db->Execute($sql);
	}
	else			{
		$SYSTEM_SECOND = 1;
		print_infor("��׼��Ϊ�ջ�������������Ϊ��,���Ĳ���û��ִ�гɹ�!",$infor='�ò����°汾û�б�ʹ��',$return="location='fixedasset_newai.php'",$indexto='fixedasset_newai.php');
		exit;
	}
}

//print_R($_POST);exit;



$filetablename='fixedassettiaoku';
require_once('include.inc.php');
?>