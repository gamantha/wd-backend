<?php

use Illuminate\Database\Seeder;

class LB1SeedProduction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // f_ indicate female
        // m_ indicate male
        $categories = [
            'f_0_7d', 'm_0_7d',
            'f_8_28d', 'm_8_28d',
            'f_1_12m', 'm_1_12m',
            'f_1_4y', 'm_1_4y',
            'f_10_14y', 'm_10_14y',
            'f_15_19y', 'm_10_19y',
            'f_20_44y', 'm_20_44y',
            'f_45_54y', 'm_45_54y',
            'f_55_59y', 'm_55_59y',
            'f_60_69y', 'm_60_69y',
            'f_70y', 'm_70y',
        ];
        // fill parent first
        DB::table('indicator')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'penyakit_infeksi_pada_usus',
                    'label' => 'PENYAKIT INFEKSI PADA USUS (Intestinal infection disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 2,
                    'name' => 'penyakit_tuberkulosis',
                    'label' => 'PENYAKIT TUBERKULOSIS (TB)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 3,
                    'name' => 'penyakit_bakteri',
                    'label' => 'PENYAKIT BAKTERI (BACTERIAL DISEASE)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 4,
                    'name' => 'penyakit_virus',
                    'label' => 'PENYAKIT VIRUS (VIRAL DISEASE)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 5,
                    'name' => 'riketsiasis_dan_penyakit_karena_arthropoda_lain',
                    'label' => 'RIKETSIASIS DAN PENYAKIT KARENA ARTHROPODA LAIN (Richettsia and other arthropode disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 6,
                    'name' => 'penyakit_kelamin',
                    'label' => 'PENYAKIT KELAMIN (Sexual Tansmitted Infection)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 7,
                    'name' => 'penyakit_infeksi_parasit_dan_akibat_kemudian',
                    'label' => 'PENYAKIT INFEKSI PARASIT DAN AKIBAT KEMUDIAN (Parasite infection and its sequele)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 8,
                    'name' => 'gangguan_mental',
                    'label' => 'GANGGUAN MENTAL (Mental disorder)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 9,
                    'name' => 'penyakit_susunan_saraf',
                    'label' => 'PENYAKIT SUSUNAN SARAF (Neurological disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 10,
                    'name' => 'penyakit_mata_dan_adeneksa',
                    'label' => 'PENYAKIT MATA DAN ADENEKSA (Eye disease/disorder)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 11,
                    'name' => 'penyakit_telinga_dan_mastoid',
                    'label' => 'PENYAKIT TELINGA DAN MASTOID (Ear and mastoid disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 12,
                    'name' => 'penyakit_tekanan_darah_tinggi',
                    'label' => 'PENYAKIT TEKANAN DARAH TINGGI (Hypertension)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 13,
                    'name' => 'penyakit_lain_pada_saluran_pernafasan_atas',
                    'label' => 'PENYAKIT LAIN PADA SALURAN PERNAFASAN ATAS (Upper respiratory tract infection)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 14,
                    'name' => 'pneumonia',
                    'label' => 'Pneumonia',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 15,
                    'name' => 'penyakit_di_rongga_mulut',
                    'label' => 'PENYAKIT DI RONGGA MULUT (Mouth and dental disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 16,
                    'name' => 'penyakit_pada_saluran_kencing',
                    'label' => 'PENYAKIT PADA SALURAN KENCING (Urinary tract infection)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 17,
                    'name' => 'sebab_kelainan_kebidanan_langsung',
                    'label' => 'SEBAB KELAINAN KEBIDANAN LANGSUNG (Obstetric disorder)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 18,
                    'name' => 'keadaan_tertentu_pada_masa_perinatal',
                    'label' => 'KEADAAN TERTENTU PADA MASA PERINATAL (Certain condition during perinatal)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 19,
                    'name' => 'kecelakaan_dan_keracunan',
                    'label' => 'KECELAKAAN DAN KERACUNAN (Accident & intoxication)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 20,
                    'name' => 'penyakit_kulit_dan_jaringan_subkutan_lainnya',
                    'label' => 'PENYAKIT KULIT DAN JARINGAN SUBKUTAN LAINNYA (Skin and other sub cutaneous disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 21,
                    'name' => 'penyakit_pada_sistem_otot_dan_jaringan_pengikat',
                    'label' => 'PENYAKIT PADA SISTEM OTOT DAN JARINGAN PENGIKAT (PENYAKIT TULANG BELAKANG, RADANG SENDI TERMASUK REMATIK ( Bone & muscle disease, including back bone disease, joint disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'id' => 22,
                    'name' => 'penyakit_lainnya',
                    'label' => 'PENYAKIT LAINNYA (other disease)',
                    'is_parent' => true,
                    'indicator_parent_id' => null,
                    'unit_label' => 'orang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
            ]
        );
        // fill child
        $childs = [ // name => label
            [ // parent 1 childs
                'kolera' => 'Kolera (Cholera)',
                'diare_termasuk_tersangka_kolera' => 'Diare (termasuk tersangka kolera) (Diarrhea, including suspect of Cholera)',
                'disentry' => 'Disentri (Dysentery)',
                'infeksi_penyakit_usus_lain' => 'Infeksi penyakit usus lain (other intestinal infection)',
            ],
            [ // parent 2 childs
                'tb_paru' => 'TB Paru (Lung TB)',
                'tb_selain_paru' => 'TB selain paru (TB Extra pulmoner)',
            ],
            [ // parent 3 childs
                'kusta_mb' => 'Kusta MB (Leprosy Multi Basiler)',
                'kusta_pb' => 'Kusta PB (Leprosy Pausi Basiler)',
                'difteria' => 'Difteria (Diphtheria)',
                'batuk_rejan' => 'Batuk rejan (Whooping cough)',
                'tetanus' => 'Tetanus',
                'plaque' => 'Pes (Plaque)',
            ],
            [ // parent 4 childs
                'poliomyelitis_akut' => 'Poliomyelitis akut (Acute poliomyelitis)',
                'campak' => 'Campak (Measles)',
                'rabies' => 'Rabies',
                'dhf_demam_berdarah_dengue' => 'DHF/Demam berdarah dengue (Dengue Hemorrhagic fever)',
                'cacar_air' => 'Cacar air (Chicken pox)',
            ],
            [ // parent 5 childs
                'malaria_dengan_pemeriksaan_lab' => 'Malaria dengan pemeriksaan lab (Malaria with lab test)',
                'malaria_tropika' => 'Malaria tropika (P.Falciparum)',
                'malaria_tanpa_pemeriksaan_lab' => 'Malaria tanpa pemeriksaan lab / malaria klinis (Clinical malaria)',
                'anthrax' => 'Anthrax',
            ],
            [ // parent 6 childs
                'infeksi_gonokok' => 'Infeksi Gonokok (Gonorrhea infection)',
                'non_gonokok' => 'Non Gonokok (Non Gonorrhea infection)',
                'penyakit_kelamin_lain' => 'Penyakit kelamin lain (other STI)'
            ],
            [ // parent 7 childs
                'frambusia' => 'Frambusia (Yows)',
                'filariasis' => 'Filariasis',
                'penyakit_cacingan' => 'Penyakit cacingan (Worm disease)',
                'scabies' => 'Scabies',
            ],
            [ // parent 8 childs
                'gangguan_psikotik' => 'Gangguan psikotik (Physotic disorder)',
                'gangguan_neurotik' => 'Gangguan neurotik (Neurotik disorder)',
                'retardasi_mental' => 'Retardasi mental (Mental retardation)',
                'gangguan_kesehatan_jiwa_bermula_pada_bayi_anak_remaja_perkembangan' => 'Gannguan kesehatan jiwa bermula pada bayi, anak , remaja dan perkembangan (early onset mental disorder)',
                'penyakit_jiwa_lainnya' => 'Penyakit jiwa lainnya (other mental disorder)'
            ],
            [ // parent 9 childs
                'epilepsi' => 'Epilepsi',
                'penyakit_dan_kelainan_susunan_saraf_lainnya' => 'Penyakit dan kelainan susunan saraf lainnya (other neurological disease)',
            ],
            [ // parent 10 childs
                'glaukoma' => 'Glaukoma',
                'katarak' => 'Katarak (Catarract)',
                'kelainan_refraksi' => 'Kelainan refraksi (Refractive disorder)',
                'kelainan_kornea' => 'Kelainan kornea (Corneal disorder)',
                'penyakit_mata_lainnya' => 'Penyakit mata lainnya (other eyes disease/disorder)',
            ],
            [ // parent 11 childs
                'infeksi_telinga_tengah' => 'Infeksi telinga tengah (Otitis media )',
                'infeksi_mastoid' => 'Infeksi mastoid (Mastoid infection)',
            ],
            [ // parent 12 childs

            ],
            [ // parent 13 childs
                'tonsilitis' => 'Tonsilitis',
                'infeksi_akut_lain_pada_saluran_nafas_atas' => 'Infeksi akut lain pada saluran nafas atas (other infection in upper respiratory)',
                'penyakit_lain_pada_saluran_nafas_bawah' => 'PENYAKIT LAIN PADA SALURAN PERNAFASAN BAWAH (Lower respiratory tract infection)',
            ],
            [ // parent 14 childs
                'bronkitis' => 'Bronkitis',
                'asma' => 'Asma',
                'penyakit_lain_dari_saluran_nafas_bawah' => 'Penyakit lain dari saluran nafas bawah (other disease from lower respiratory)',
            ],
            [ // parent 15 childs
                'karies_gigi' => 'Karies gigi (tooth caries)',
                'penyakit_pulpa_dan_jaringan_periapikal' => 'Penyakit pulpa dan jaringan periapikal (Pulp and periapical disease)',
                'gingivitis_dan_penyakit_periodontal' => 'Gingivitis dan penyakit periodontal (Gingivitis & periodontal disease)',
                'gangguan_gigi_dan_jaringan_penyangga_lain' => 'Gangguan gigi dan jaringan penyangga lain (dental an other supporting tissue disorder)',
                'penyakit_rongga_mulut_kelenjar_ludah_rahang_dan_lainnya' => 'Penyakit rongga mulut, kelenjar ludah, rahang dan lainnya (Mouth, gland saliva, jaws and other disease)',
            ],
            [ // parent 16 childs

            ],
            [ // parent 17 childs
                'keguguran' => 'Keguguran (Miscarriage)',
                'pendarahan_pada_kehamilan_persalinan_dan_masa_nifas' => 'perdarahan pada kehamilan, persalinan dan masa nifas (bleeding during pregnancy, delivery and post partum)',
                'keracunan_kehamilan' =>  'Keracunan kehamilan (Eklampsia)',
                'partus_lama' => 'Partus lama (Prolonged labour)',
                'infeksi_pada_masa_kehamilan_persalinan_dan_masa_nifas' => 'Infeksi pada masa kehamilan, persalinan dan nifas (Infection during pregancy, delivery and post partum)',
                'hyperemesis' => 'Hyperemesis',
            ],
            [ // parent 18 childs
                'trauma_lahir' => 'Trauma lahir (birth trauma)',
                'asfiksia' => 'Asfiksia (Asphyxia)',
                'tetanus_neonatarum' => 'Tetanus neonatorum',
            ],
            [ // parent 19 childs
                'kecelakaan_dan_ruda_paksa' => 'Kecelakaan dan ruda paksa (Accident & trauma)',
                'keracunan_bahan_kimia' => 'Keracunan bahan kimia (Chemical intoxication)',
                'keracunan_makanan' => 'Keracunan makanan (food intoxication)',
            ],
            [ // parent 20 childs
                'penyakit_kulit_infeksi' => 'Penyakit kulit infeksi (skin infection)',
                'penyakit_kulit_alergi' => 'Penyakit kulit alergi (Skin allergic)',
                'penyakit_karena_jamur' => 'Penyakit karena jamur (Skin infection ec fungal)',
            ],
            [ // parent 21 childs

            ],
            [ // parent 22 childs
                'infeksi_pada_umbilikus' => 'Infeksi pada umbilikus (umbilical cord infection)',
                'alergi_makanan' => 'alergi makanan (food allergy)',
                'fixed_drug_eruption' => 'fixed drug eruption (FDE)',
                'syok' => 'Syok (Shock)',
                'anemia' => 'Anemia',
                'sida' => 'SIDA (AIDS)',
                'limfadenitis' => 'Limfadenitis',
                'refluks_gastroesofageal' => 'Refluks gastroesofageal (GERD) (Gastroesofageal reflux disease)',
                'suspect_gastritis' => 'Suspect gastritis/dispepsia (Dyspepsia)',
                'intoleransi_makanan' => 'Intoleransi makanan (Food intolerance)',
                'demam_tifoid' => 'Demam Tifoid (Thypoid fever)',
                'pendarahan_saluran_makan_bagian_atas' => 'Perdarahan saluran makan bagian atas (upper digestive tract bleeding)',
                'perdarahan_saluran_makan_bagian_bawah' => 'Perdarahan saluran makan bagian bawah (Lower digestive tract bleeding) ',
                'hordeolum' => 'Hordeolum',
                'konjungtivitis' => 'Konjungtivitis',
                'blefaritis' => 'Blefaritis',
                'perdarahan_subkonjungtiva' => 'Perdarahan subkonjungtiva (Sub conjungtival bleeding)',
                'benda_asing_di_konjungtiva' => 'Benda asing di konjungtiva (foreign body in conjungtiva)',
                'otitis_externa' => 'Otitis externa (External ear infection)',
                'seruman_prop' => 'Serumen prop (Earwax blockage)',
                'benda_asing_di_hidung' => 'Benda asing di hidung (Foreign body in nose)',
                'angina_pektoris' => 'Angina pektoris (Chest pain)',
                'infark_miokard' => 'Infark miokard (Myocardial infarction)',
                'aritmia_cordis' => 'Aritmia cordis (iregular heart rhytm)',
                'gagal_jantung' => 'Gagal jantung (heart failure)',
                'cardiorespiratory_arrest' => 'Cardiorespiratory arrest',
                'stroke_infark_serebral' => 'Stroke infark serebral',
                'lipoma_cyst_ateroma_ganglioma' => 'Lipoma, cyst, Ateroma, Ganglioma',
                'kejang_demam' => 'Kejang demam (Febril seizure)',
                'vertigo' => 'Vertigo',
                'delirium' => 'Delirium',
                'migrain' => 'Migrain',
                'bells_palsy' => 'Bells Palsy',
                'tension_headache' => 'Tension headache',
                'dementia' => 'Dementia',
                'epistaksis' => 'Epistaksis (Bleeding from nose)',
                'furunkel' => 'Furunkel (boils)',
                'luka_bakar_derajat_1_dan_2' => 'Luka bakar derajat 1 dan 2 (Burn wound first and second degree)',
                'diabetes_mellitus' => 'Diabetes mellitus',
                'malnutrisi_energi_protein' => 'malnutrisi energi protein (Malnutrition)',
                'hiperurisemia' => 'Hiperurisemia/Gout artrhitis',
                'dislipidemia' => 'Dislipidemia/hipercholesterolemia',
                'kehamilan_normal' => 'Kehamilan normal (normal pregnancy',
                'pre_eclampsia' => 'pre eclampsia',
                'ketuban_pecah_dini' => 'Ketuban pecah dini (Premature rupture of membrane)',
                'mastitis' => 'Mastitis',
            ]
        ];
        $childArranged = [];
        foreach ($childs as $key => $value) {
            // parent 
            $parent_id = $key + 1;
            foreach ($value as $sub_key => $sub_value) {
                foreach ($categories as $category) {
                    array_push($childArranged,[
                        'name' => $sub_key . '_' . $category,
                        'label' => $sub_value,
                        'is_parent' => false,
                        'indicator_parent_id' => $parent_id,
                        'unit_label' => 'orang',
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                }
            }
        }
        DB::table('indicator')->insert(
            $childArranged,
        );
    }
}
