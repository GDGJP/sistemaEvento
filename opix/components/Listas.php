<?php
	class Listas {

		public static function getFuncao() {

			return array(
				'participante' => 'Participante',
				'palestrante' => 'Palestrante',
				'staff' => 'Staff',
				'expositor' => 'Expositor'
			);

		}

		public static function getSexo() {

			return array(
				'm' => 'Masculino',
				'f' => 'Feminino'
			);

		}

		public static function getAreaAtuacao() {

			return array(
					'terceiro_setor' => '3º Setor',
					'governamental' => 'Governamental',
					'empresarial' => 'Empresarial',
					'academica' => 'Acadêmica'
			);

		}

		public static function getGrauInstrucao() {

			return array(
				'nenhum' => 'Nenhum',
				'fundamental_incompleto' => 'Ensino Fundamental Incompleto',
				'fundamental_completo' => 'Ensino Fundamental Completo',
				'medio_incompleto' => 'Ensino Médio Incompleto',
				'medio_completo' => 'Ensino Médio Completo',
				'tecnico_incompleto' => 'Ensino Técnico Incompleto',
				'tecnico_completo' => 'Ensino Técnico Completo',
				'superior_incompleto' => 'Ensino Superior Incompleto',
				'superior_completo' => 'Ensino Superior Completo',
				'mestrado' => 'Mestrado',
				'doutorado' => 'Doutorado',
				'pos_doutorado' => 'Pós-Doutorado'
			);

		}

		public static function getTamanhoCamisa() {

			return array(
				'p' => 'P',
				'm' => 'M',
				'g' => 'G',
				'gg' => 'GG',
				'xgg' => 'XGG'
			);

		}

	}