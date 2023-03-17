<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ContratosController extends Controller
{

    private static function getCnpj()
    {
        try {
            $cnpj = DB::table('tbcliente')
                ->select('cnpj_cpf')
                ->where('statuss', 1)
                ->get();

            return $cnpj;
        } catch (Exception $e) {
            exit("getCnpj: " . $e->getMessage());
        }
    }

    public function getContratos()
    {
        try {

            $cnpjs = [
                '01617384000159',
                '17416355000169',
                '10591946000123',
                '01617384000310',
                '11233223000115',
                '23254071000116',
                '05921314000140',
                '30296871000165',
                '27651784000174',
                '17363771000146',
                '03920179000193',
                // '00542386000163',
                // '03841584000116',
                // '02621291000160',
                // '01658399000165',
                // '06018590000166',
                // '14823029000188',
                // '10839691000175',
                // '18825267000183',
                // '22231401000195',
                // '07614220000154',
                // '09163790000109',
                // '03654243000131',
                // '16873523000182',
                // '66443987000127',
                // '02239695000194',
                // '01882994000180',
                // '11006782000192',
                // '01103144000136',
                // '01519452000147',
                // '16629421000116',
                // '04234330000100',
                // '20539319000105',
                // '22297971000188',
                // '08835124000107',
                // '26370636000119',
                // '26710419000120',
                // '07277440000130',
                // '08395644000138',
                // '32800001000107',
                // '58160656000313',
                // '33269117000124',
                // '11272927000369',
                // '26797701000197',
                // '32286451000123',
                // '10515883000126',
                // '21506563000126',
                // '65227365000107',
                // '14215044000143',
                // '22623490000115',
                // '02401584000132',
                // '21006724000112',
                // '26598360000120',
                // '26664239000150',
                // '26624821000192',
                // '42832691000130',
                // '00925031000153',
                // '02994816000103',
                // '13493944000190',
                // '09567643000196',
                // '18788851000106',
                // '10771858000103',
                // '38739819000148',
                // '08858040000180',
                // '11699690000135',
                // '07186157000100',
                // '09057353000100',
                // '05909468000117',
                // '03745779000162',
                // '19396381000106',
                // '00200370000172',
                // '04379775000170',
                // '17435033000167',
                // '03018311000176',
                // '71293708000126',
                // '14311771000104',
                // '14778158000100',
                // '16814632000129',
                // '16830884000141',
                // '10857931000164',
                // '16992709000150',
                // '17397195000158',
                // '01519452000490',
                // '17741768000119',
                // '11066879000190',
                // '25145491000190',
                // '22151586000128',
                // '01658399000246',
                // '22355855000178',
                // '23119160000150',
                // '19049086000175',
                // '10515883000398',
                // '23495952000129',
                // '18397060000155',
                // '04024938000100',
                // '18903423000187',
                // '23707677000160',
                // '26331790000181',
                // '27100954000122',
                // '22136642000155',
                // '09222369000113',
                // '71505564000124',
                // '23253125000129',
                // '26728307000105',
                // '27044554000147',
                // '27218230000188',
                // '28116615000105',
                // '05125915000147',
                // '01152672000185',
                // '25406595000100',
                // '05125915000309',
                // '30641506000140',
                // '27622025000183',
                // '31080953000130',
                // '31401798000107',
                // '31947733000161',
                // '31710979000115',
                // '31957284000132',
                // '32170616000105',
                // '31047990000147',
                // '11272927000288',
                // '34230509000142',
                // '34841812000181',
                // '19324776000195',
                // '35085392000113',
                // '32331864000182',
                // '10595739000147',
                // '05202611000136',
                // '17416355000592',
                // '25681529000149',
                // '05443741000160',
                // '19396763000121',
                // '05441797000186',
                // '05266324000190',
                // '05266324000351',
                // '05266324000513',
                // '05266324000602',
                // '05266324000270',
                // '05266324000432',
                // '07053660000180',
                // '11272927000105',
                // '02434986000133',
                // '65164618000132',
                // '00641174000133',
                // '11278588000166',
                // '71256283000185',
                // '04333394000150',
                // '01239313000402',
                // '07450765000172',
                // '11278588000247',
                // '28737615000114',
                // '21085708000162',
                // '01492641000173',
                // '10483186000130',
                // '04890178000106',
                // '07067399000177',
                // '01208327000116',
                // '02330473000182',
                // '19362807000100',
                // '05201607000153',
                // '09143395000156',
                // '17235086000134',
                // '02891358000187',
                // '10411479000102',
                // '23725796000145',
                // '23725837000101',
                // '10379716000103',
                // '27456890000105',
                // '11905055000167',
                // '04388439000194',
                // '17787391000139',
                // '06216260000185',
                // '26158527000132',
                // '10498193000106',
                // '14184135000169',
                // '01410268000164',
                // '08004656000194',
                // '04811134000143',
                // '66403940000130',
                // '00930314000193',
                // '64312481000153',
                // '14315277000118',
                // '08866837000120',
                // '26308767000176',
                // '09400465000104',
                // '19729164000182',
                // '03492001000199',
                // '05488568000117',
                // '17810998000192',
                // '18909658000186',
                // '21984105000100',
                // '28595719000131',
                // '29179436000171',
                // '27868497000110',
                // '32564363000146',
                // '32632088000150',
                // '33990232000193',
                // '36067439000189',
                // '04380260000190',
                // '34758810000123',
                // '01940414000244',
                // '10309119000102',
                // '07109928000158',
                // '05245104000180',
                // '28736298000111',
                // '26718685000108',
                // '04033435000193',
                // '23413032000114',
                // '97397491000198',
                // '10499328000158',
                // '07322295000161',
                // '07761476000194',
                // '01160628000117',
                // '07365564000177',
                // '65296881000185',
                // '25568759000104',
                // '06261470000195',
                // '13602194000147',
                // '05750194000166',
                // '20492641000118',
                // '04921346000183',
                // '11815840000129',
                // '06977269000109',
                // '05957273000142',
                // '07428353000136',
                // '06077962000125',
                // '25300617000153',
                // '12364449000118',
                // '07125576000124',
                // '20965430000155',
                // '97551617000137',
                // '09597171000114',
                // '03554464000138',
                // '01139851000182',
                // '23801780000174',
                // '71223598000126',
                // '05641175000100',
                // '14202793000136',
                // '70982921000182',
                // '17270968000130',
                // '01940414000163',
                // '04696130000161',
                // '02355525000175',
                // '03238677000150',
                // '21507959000198',
                // '03834834000190',
                // '07067995000157',
                // '04433998000179',
                // '04315499000187',
                // '15311375000140',
                // '08106392000180',
                // '25160904000105',
                // '17470950000182',
                // '03539398000127',
                // '14111321000178',
                // '18181460000129',
                // '10935357000115',
                // '11916165000124',
                // '09640019000177',
                // '17993923000194',
                // '22356297000165',
                // '04022245000170',
                // '22660512000117',
                // '22817749000169',
                // '19098932000147',
                // '08457173000145',
                // '05889344000117',
                // '25032393000146',
                // '01208961000159',
                // '22386049000167',
                // '23539178000100',
                // '42940817000190',
                // '04653491000120',
                // '23961797000199',
                // '04653491000201',
                // '08825698000196',
                // '25526854000137',
                // '26300176000152',
                // '25528987000142',
                // '26758244000121',
                // '05291741000192',
                // '26732878000105',
                // '26727186000179',
                // '08017663000120',
                // '25708520000184',
                // '25293215000179',
                // '24295988000121',
                // '26395502000152',
                // '21982722000169',
                // '27229943000147',
                // '24654466000179',
                // '27382824000120',
                // '04333394002447',
                // '06347040000190',
                // '07591757000146',
                // '28016581000179',
                // '28078490000168',
                // '22386049000248',
                // '28778906000150',
                // '28931992000190',
                // '29172573000184',
                // '29205452000191',
                // '29254086000160',
                // '29255050000100',
                // '29437143000147',
                // '22141271000108',
                // '29924284000194',
                // '27676415000136',
                // '28210560000190',
                // '31332550000131',
                // '24471769000156',
                // '32905199000193',
                // '26500067000189',
                // '36092650000151',
                // '34033466000105',
                // '34036789000152',
                // '11355691000162',
                // '18750200000127',
                // '18750200000208',
                // '31314009000109',
                // '21666361000141',
                // '09231268000109',
                // '34857929000153',
                // '34857108000117',
                // '32871038000126',
                // '00043536506615',
                // '00012596469634',
                // '00008049105610',
                // '00015142760620',
                // '00049419781615',
                // '00022240098600',
                // '00023071168691',
                // '00027906990625',
                // '00081432160630',
                // '00076076423668',
                // '17261661004918',
                // '17261661006104',
                // '17261661006295',
                // '17261661011965',
                // '00007345970612',
                // '35296233000168',
                // '00015623084672',
                // '00006000835191',
                // '17416355000401',
                // '17261661006376',
                // '00003470802602',
                // '00082926107668',
                // '00074556673615',
                // '00015008908634',
                // '03842691000169',
                // '00085753688691',
                // '00005256067699',
                // '22195820000119',
                // '00002577123647',
                // '00008260680653',
                // '00000867268620',
                // '00066656940625',
                // '00000234310677',
                // '00005851406690',
                // '00045183872600',
                // '14771998000132',
                // '17416355000240',
                // '31760517000102',
                // '25012454000103',
                // '00005094720600',
                // '36313588000180',
                // '33921411000179',
                // '21235147000130',
                // '30396321000118',
                // '33113348000144',
                // '93186914000170',
                // '32580910000187',
                // '36604159000162',
                // '36258326000160',
                // '36734314000165',
                // '03539398000208',
                // '10833144000182',
                // '12523304000112',
                // '19761811000133',
                // '36752636000137',
                // '03543526000106',
                // '22297971000269',
                // '32800001000298',
                // '32800001000379',
                // '36965381000190',
                // '37010174000145',
                // '37082870000167',
                // '11237026000174',
                // '00005170246676',
                // '73691206000189',
                // '08769965000155',
                // '00046531114649',
                // '37934555000110',
                // '37656371000136',
                // '37724258000140',
                // '03218854000137',
                // '03218854000218',
                // '03218854000307',
                // '03218854000480',
                // '03218854000560',
                // '03218854000641',
                // '03218854000722',
                // '06141426000141',
                // '11573166000113',
                // '38159203000106',
                // '00004989893646',
                // '38245317000160',
                // '15554813000109',
                // '38243197000162',
                // '38492833000190',
                // '38427598000172',
                // '38400004000130',
                // '11369542000152',
                // '28761717000175',
                // '39247603000128',
                // '38948695000100',
                // '34890135000191',
                // '36060956000126',
                // '37553118000157',
                // '39565567000140',
                // '39540931000118',
                // '39309982000133',
                // '00001224709667',
                // '27080096000100',
                // '39808099000198',
                // '20614632000152',
                // '39843779000142',
                // '37112395000124',
                // '40384501000133',
                // '30659834000174',
                // '32185491000189',
                // '41286702000160',
                // '41332695000196',
                // '34857929000234',
                // '41451871000109',
                // '00007454865763',
                // '21127330000112',
                // '10416442000177',
                // '00075898888691',
                // '22297971000340',
                // '50007822000172',
                // '09054655000117',
                // '06018590001308',
                // '20422248000239',
                // '14552510000186',
                // '42167746000134',
                // '97397491000279',
                // '26746932000171',
                // '03963585000133',
                // '32800001000450',
                // '42215499000102',
                // '39600948000113',
                // '34320834000104',
                // '42542409000180',
                // '42591154000145',
                // '03218854000803',
                // '03218854000994',
                // '09518122000149',
                // '02311196000160',
                // '36976400000184',
                // '42772934000191',
                // '42829419000109',
                // '35289386000188',
                // '01492641000254',
                // '42983705000116',
                // '27864372000112',
                // '43113907000170',
                // '20210759000106',
                // '34192515000152',
                // '17768344000148',
                // '13645199000157',
                // '27515607000160',
                // '15145811000158',
                // '41948720000160',
                // '41948720000403',
                // '41948720000594',
                // '25108970000306',
                // '25108970000489',
                // '43382296000165',
                // '43356840000102',
                // '00000844004634',
                // '35296233000249',
                // '32800001000530',
                // '39253739000140',
                // '00000000990400',
                // '00000000990663',
                // '02896003000342',
                // '05437257000129',
                // '08828876000132',
                // '00065359089687',
                // '34790420000130',
                // '43966624000170',
                // '20617916000100',
                // '00029339090659',
                // '05441797000267',
                // '09066194001093',
                // '05454133000151',
                // '44108859000194',
                // '17283276000127',
                // '17283276000550',
                // '05266324000785',
                // '20422248000409',
                // '00005256067699',
                // '44615621000155',
                // '04081131000100',
                // '31314009000281',
                // '31314009000362',
                // '31314009000443',
                // '31314009000524',
                // '31314009000605',
                // '00049417533649',
                // '00067715052604',
                // '42564929000193',
                // '37873443000105',
                // '18331986000148',
                // '45051340000180',
                // '11087492000110',
                // '17032673000126',
                // '18570713000156',
                // '00152687000180',
                // '27434409000172',
                // '05125915000651',
                // '17574301000121',
                // '13110511000108',
                // '37796039000177',
                // '04382585000102',
                // '04382585000293',
                // '45195319000158',
                // '23539178000453',
                // '23539178000372',
                // '23539178000291',
                // '19906673000133',
                // '44926315000130',
                // '25681529000572',
                // '45509037000188',
                // '20496269000118',
                // '45837563000177',
                // '26945397000188',
                // '12538334000100',
                // '12538334000283',
                // '20422248000158',
                // '20422248000310',
                // '00006846372601',
                // '41866518000190',
                // '69574515000100',
                // '32890236000137',
                // '07824540000139',
                // '31312791000119',
                // '10478835000105',
                // '45853567000149',
                // '38419155000130',
                // '08968072000139',
                // '34532626000160',
                // '11372382000109',
                // '46420591000157',
                // '46420591000238',
                // '37927133000118',
                // '42158668000101',
                // '40189881000155',
                // '40989007000100',
                // '05633719000183',
                // '13605741000148',
                // '09385611000170',
                // '09385611000250',
                // '09385611000412',
                // '09385611000501',
                // '05071823000121',
                // '05071823000202',
                // '05071823000393',
                // '34906709000172',
                // '34906709000253',
                // '34058045000139',
                // '34058045000210',
                // '33136639000158',
                // '33113474000107',
                // '34046817000112',
                // '13250043000177',
                // '13250043000258',
                // '47063659000150',
                // '32176720000107',
                // '11328040000183',
                // '11328040000264',
                // '11328040000345',
                // '11328040000426',
                // '11328040000507',
                // '11328040000698',
                // '00036685678836',
                // '46713115000124',
                // '45110465000133',
                // '05801871000128',
                // '02979164000138',
                // '22297971000420',
                // '46438568000190',
                // '05960613000194',
                // '18227597000177',
                // '35787964000106',
                // '35787964000297',
                // '26746932000252',
                // '23539178000534',
                // '47146149000147',
                // '00000000990825',
                // '47600664000155',
                // '47609827000160',
                // '05801871000209',
                // '46264187000131',
                // '47093434000147',
                // '05396813000166',
                // '20446787000127',
                // '47692452000145',
                // '00001817380907',
                // '06018590001480',
                // '48049512000179',
                // '48068073000141',
                // '37635972000162',
                // '48126887000195',
                // '39812363000167',
                // '28630353000194',
                // '11280638000220',
                // '47489246000132',
                // '48165399000197',
                // '48289157000105',
                // '00007740516635',
                // '23539178000615',
                // '23539178000704',
                // '23539178000887',
                // '00835847000196',
                // '37900434000158',
                // '33113425000166',
                // '30793976000120',
                // '37131510000108',
                // '47080639000198',
                // '10767281000166',
                // '46057007000140',
                // '48552474000172',
                // '42346457000100',
                // '42346457000283',
                // '42346457000445',
                // '42346457000526',
                // '42346457000607',
                // '42346457000798',
                // '42346457000879',
                // '42346457000950',
                // '42346457000364',
                // '25681529000653',
                // '44926315000210',
                // '48684457000199',
                // '08739985000183',
                // '38258668000106',
                // '21127330000201',
                // '23941433000147',
                // '01519452000570',
                // '01519452000651',
                // '45944876000124',
                // '47064018000110',
                // '47064018000200',
                // '22242792000143',
                // '22242792000224',
                // '22242792000496',
                // '07165786000146',
                // '07165786000227',
                // '20486259000100',
                // '30544219000112',
                // '45843904000117',
                // '47083552000174',
                // '47233428000148',
                // '48817130000148',
                // '02958190000180',
                // '07067995000238',
                // '48813267000124',
                // '10548579000185',
                // '48883749000150',
                // '44691732000140',
                // '08968072000210',
                // '49091204000174',
                // '49091153000180',
                // '11357769000188',
                // '11357769000340',
                // '07639722000130',
                // '19039516000178',
                // '49167188000156',
                // '21528145000130',
                // '39565567000221',
                // '39565567000302',
                // '39565567000493',
                // '34460108000189',
                // '49272592000190',
                // '19346467000116',
                // '48093906000124',
                // '49304040000116',
                // '49301110000182',
                // '02849903000177',
                // '00006585657616',
                // '22929198000125',
                // '30080412000140',
                // '30080412000220',
                // '30080412000301',
                // '30080412000492',
                // '30080412000654',
                // '46557388000127',
                // '45565422000142',
                // '45567520000119',
                // '46556978000135',
                // '46556572000152',
                // '35352975000163',
                // '20389940000121',
                // '37087503000156',
                // '23568119000160',
                // '46963652000122',
                // '12233255000183',
                // '36498130000143',
                // '09372150000109',
                // '34697006000181',
                // '37778285000104',
                // '31951588000192',
                // '05872123000136',
                // '05872123000489',
                // '00023318164844',
                // '47183730000139',
                // '47432841000131',
                // '47183456000106',
                // '39721471000124',
                '48689564000100'
            ];

            foreach ($cnpjs as $cnpj) {
                $contratos = Http::post('https://app.omie.com.br/api/v1/servicos/contrato/', [
                    'call' => 'ListarContratos',
                    'app_key' => '219404447262',
                    'app_secret' => '2c1d5ee2df37fe502681716fd4b0d683',
                    'param' => [
                        ["filtrar_cnpj_cpf" => $cnpj]
                    ]
                ]);
                if ($contratos->status() !== 500) {
                    foreach ($contratos['contratoCadastro'] as $contrato) {
                        $situacao = $contrato['cabecalho']['cCodSit'];
                        if ($situacao === '10') {
                            echo $cnpj . " - " . $situacao . " - " . $contrato['cabecalho']['nCodCtr'] . "\n";
                        } else {
                            echo $cnpj . " - " . $situacao . " - " . "erro" . "\n";
                        }
                    }
                }
            }

            // return json_decode($contrato);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    private static function getListaContasReceber()
    {
        try {
            $cnpjs = self::getCnpj();
            $cods_omie = [];

            foreach ($cnpjs as $cnpj) {
                $contas = Http::post('https://app.omie.com.br/api/v1/financas/contareceber/', [
                    'call' => 'ListarContasReceber',
                    'app_key' => '219404447262',
                    'app_secret' => '2c1d5ee2df37fe502681716fd4b0d683',
                    'param' => [
                        [
                            "filtrar_por_cpf_cnpj" => $cnpj->cnpj_cpf,
                            "filtrar_por_data_de" => "01/03/2023",
                            "filtrar_por_data_ate" => "16/03/2023"
                        ]
                    ]
                ]);
                if ($contas->status() !== 500) {
                    foreach ($contas['conta_receber_cadastro'] as $conta) {
                        $cod_omie = $conta['codigo_lancamento_omie'];
                        array_push($cods_omie, $cod_omie);
                    }
                }
            }
            return $cods_omie;
        } catch (Exception $e) {
            exit("getListaContasReceber: " . $e->getMessage());
        }
    }

    public function getConsultaContasReceber()
    {
        try {
            $contas = self::getListaContasReceber();

            foreach ($contas as $conta) {
                $lancamentos = Http::post('https://app.omie.com.br/api/v1/financas/contareceber/', [
                    "call" => "ConsultarContaReceber",
                    "app_key" => "219404447262",
                    "app_secret" => "2c1d5ee2df37fe502681716fd4b0d683",
                    "param" => [
                        [
                            "codigo_lancamento_omie" => $conta,
                        ]
                    ]
                ]);

                if ($lancamentos->status() !== 500) {
                    print_r($lancamentos['codigo_cliente_fornecedor']);
                    print_r($lancamentos['valor_documento']);
                    print_r($lancamentos['status_titulo']);
                    print_r($lancamentos['observacao']);
                    echo "\n";
                }
            }
        } catch (Exception $e) {
            exit("getConsultaContasReceber: " . $e->getMessage());
        }
    }
}
