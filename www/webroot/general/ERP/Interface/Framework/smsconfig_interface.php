<?php
/*
 ��Ȩ����:֣�ݵ���Ƽ��������޹�˾;
 ��ϵ��ʽ:0371-69663266;
 ��˾��ַ:����֣�ݾ��ü��������������־�����·ͨ�Ų�ҵ԰��¥����;
 ��˾���:֣�ݵ���Ƽ��������޹�˾λ���й��в�����-֣��,������2007��1��,�����ڰѻ����Ƚ���Ϣ����������ͨ�ż���������ѹ�����ҵ��ʵ���ռ���������ҵ�ͻ��Ĺ�����ҵ���»�У�ȫ���ṩ��������֪ʶ��Ȩ�Ľ������������������������������в�������ĸ�У����������������СѧУ���������ṩ�̡�Ŀǰ�����ж�Ҹ�ְ����ְ��ԺУʹ��ͨ���в��з����Ŀ����������ͷ���;

 ��������:����Ƽ��������������Լܹ�ƽ̨,�Լ��������֮����չ���κ���������Ʒ;
 ����Э��:���ֻ�У԰��ƷΪ��ҵ����,��������ΪLICENSE��ʽ;����CRMϵͳ��SunshineCRMϵͳΪGPLV3Э������,GPLV3Э�����������뵽�ٶ�����;
 ��������:������ʹ�õ�ADODB��,PHPEXCEL��,SMTARY���ԭ��������,���´���������������;
 */

require_once( "lib.inc.php" );
$GLOBAL_SESSION = returnsession( );
$common_html = returnsystemlang( "common_html" );
page_css( "System Setting" );
validateMenuPriv("ϵͳ��������");
$goalfile = "global_config.ini";
	
//print_r($_POST);exit;
if ( $_GET['action'] == "" || $_GET['action'] == "init" )
{
	@$ini_file = @parse_ini_file( $goalfile,true);
	
	form_begin( "form1", "action=updatedata" );
	table_begin( );
	print_title("���Žӿ�����");
	print_tr( "���ŷ�����IP:", "SmsServerIP", $ini_file[section][SmsServerIP], 25, 1, "SmallInput", "" );
	print_tr( "�����˺ţ�", "SmsLoginID", $ini_file[section][SmsLoginID], 25, 1, "SmallInput", "" );
	print_tr( "����:", "SmsLoginPWD", $ini_file[section][SmsLoginPWD], 25, 1, "SmallInput", "","password" );

	print_title("��������");
	print_tr( "1�����ֶ�Ӧ���:", "integral", $ini_file[section][integral], 25, 1, "SmallInput", "" );

	print_title("��ӡ����");
	print('<tr>
				<td class="TableData" nowrap="" width="20%">���ݴ�ӡ��ʽ���ã�</td>
				<td class="TableData" nowrap="" colspan="1">
				
					<input type="button" value="����СƱ" class="SmallButtonB" onclick="location=\'sellone_print_config_interface.php\';">&nbsp;&nbsp;
				</td>
			</tr>');
	
	print_tr( "ֽ�ſ���(mm):", "width", $ini_file[paper_size][width], 25, 1, "SmallInput", "" );
	print_tr( "ֽ�Ÿ߶�(mm):", "height", $ini_file[paper_size][height], 25, 1, "SmallInput", "" );
	
	print_title("�ͻ����ϱ�������");
	$select1='';
	$select2='';
	if($ini_file[kehuprotect][limitEditDel]=='0')
		$select2="checked";
	else 
		$select1="checked";
	print('<tr>
				<td class="TableData" nowrap="" colspan="2">
					<label><input type="radio" value="1" name="limitEditDel" '.$select1.'>�����ϼ��༭ɾ���ͻ�����</label>&nbsp;
					<label><input type="radio" value="0" name="limitEditDel" '.$select2.'>ֻ�пͻ������߲��ܱ༭ɾ���ͻ�����</label>
				</td>
			</tr>');
	print_submit( $common_html['common_html']['submit'] );
	table_end( );
	form_end( );
}
if ( $_GET['action'] == "updatedata" )
{
	if ( is_file( $goalfile ) )
	{
		unlink( $goalfile );
	}
	$goalfile = $goalfile;
	$string = "[section]\nSmsServerIP={$_POST['SmsServerIP']}\n";
	$string .= "SmsLoginID={$_POST['SmsLoginID']}\n";
	$string .= "SmsLoginPWD={$_POST['SmsLoginPWD']}\n";
	$string .= "integral={$_POST['integral']}\n";
	
	$string .= "[paper_size]\n";
	$string .= "width=".intval($_POST['width'])."\n";
	$string .= "height=".intval($_POST['height'])."\n";
	
	$string .= "[kehuprotect]\n";
	$string .= "limitEditDel=".intval($_POST['limitEditDel'])."\n";
	
	!( $handle = @fopen( $goalfile, "w" ) );
	if ( !fwrite( $handle, $string ) )
	{
		exit();
	}
	fclose( $handle );
	page_css( "Configure" );
	$showtext = "�������!";
	$_SESSION['SmsServerIP']=$_POST['SmsServerIP'];
	$_SESSION['SmsLoginID']=$_POST['SmsLoginID'];
	$_SESSION['SmsLoginPWD']=$_POST['SmsLoginPWD'];
	$_SESSION['integral']=$_POST['integral'];
	$_SESSION['limitEditDel']=$_POST['limitEditDel'];
	//				$_SESSION['EmailAddress']=$_POST['EmailAddress'];
	//				$_SESSION['EmailPassword']=$_POST['EmailPassword'];
	print_infor( $showtext, "trip", "location='smsconfig_interface.php'","smsconfig_interface.php",1 );
}
?>