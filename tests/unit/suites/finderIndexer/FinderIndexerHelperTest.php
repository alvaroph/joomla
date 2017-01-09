<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/helper.php';

/**
 * Test class for FinderIndexerHelper.
 * Generated by PHPUnit on 2012-06-10 at 14:41:01.
 */
class FinderIndexerHelperTest extends TestCaseDatabase
{
	/**
	 * Gets the data set to be loaded into the database during setup
	 *
	 * @return  PHPUnit_Extensions_Database_DataSet_CsvDataSet
	 *
	 * @since   3.1
	 */
	protected function getDataSet()
	{
		$dataSet = new PHPUnit_Extensions_Database_DataSet_CsvDataSet(',', "'", '\\');

		$dataSet->addTable('jos_extensions', JPATH_TEST_DATABASE . '/jos_extensions.csv');
		$dataSet->addTable('jos_finder_terms_common', JPATH_TEST_DATABASE . '/jos_finder_terms_common.csv');
		$dataSet->addTable('jos_finder_types', JPATH_TEST_DATABASE . '/jos_finder_types.csv');

		return $dataSet;
	}

	/**
	 * Tests the parse method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testParse()
	{
		$this->assertEquals(
			'Test string to parse with the txt parser',
			FinderIndexerHelper::parse('Test string to parse with the txt parser', 'txt'),
			'Tests that FinderIndexerHelper::parse() returns the string given with the txt parser.'
		);
	}

	public function testStem()
	{
		$this->assertEquals(
			FinderIndexerHelper::stem('token', 'en'),
			'token'
		);
	}

	/**
	 * Tests the addContentType method
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testAddContentType()
	{
		$this->assertEquals(
			4,
			FinderIndexerHelper::addContentType('Article'),
			'Tests that addContentType returns the ID for an already existing type.'
		);

		$existingIds = array('1', '2', '3', '4', '5', '6');
		$newTypeId   = FinderIndexerHelper::addContentType('PHPUnit');

		$this->assertFalse(
			in_array($newTypeId, $existingIds),
			'Tests that the new ID does not already exist in the database.'
		);
	}

	/**
	 * Tests the isCommon method
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public function testIsCommon()
	{
		$this->assertTrue(
			FinderIndexerHelper::isCommon('the', 'en'),
			'Tests that FinderIndexerHelper::isCommon() returns true for a common term.'
		);

		$this->assertFalse(
			FinderIndexerHelper::isCommon('joomla', 'en'),
			'Tests that FinderIndexerHelper::isCommon() returns false for an uncommon term.'
		);
	}

	/**
	 * Tests the getDefaultLanguage method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testGetDefaultLanguage()
	{
		$this->assertEquals(
			'en-GB',
			FinderIndexerHelper::getDefaultLanguage(),
			'The default language is en-GB'
		);
	}

	/**
	 * Tests the getPrimaryLanguage method
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function testGetPrimaryLanguage()
	{
		$this->assertEquals(
			'en',
			FinderIndexerHelper::getPrimaryLanguage('en-GB'),
			'The primary language is en'
		);
	}
}
