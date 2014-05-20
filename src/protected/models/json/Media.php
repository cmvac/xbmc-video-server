<?php

/**
 * Base class for all media items (movies, TV shows, episodes). This class 
 * contains fields that can be found in all the base classes.
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2013-
 * @license https://www.gnu.org/licenses/gpl.html The GNU General Public License v3.0
 */
abstract class Media extends CComponent
{

	/**
	 * @var string
	 */
	public $label;

	/**
	 * @var string
	 */
	public $thumbnail;

	/**
	 * @var float
	 */
	public $rating;

	/**
	 * @var int
	 */
	public $runtime;

	/**
	 * @var string
	 */
	public $file;

	/**
	 * @var int
	 */
	public $year;

	/**
	 * @var array
	 */
	public $genre = array();

	/**
	 * @var array
	 */
	public $cast;

	/**
	 * @var string
	 */
	public $mpaa;

	/**
	 * @var string
	 */
	public $plot;

	/**
	 * @var string
	 */
	public $imdbnumber;

	/**
	 * @var object
	 */
	public $streamdetails;

	/**
	 * @return the ID of this item
	 */
	abstract public function getId();

	/**
	 * @return the display name of this item
	 */
	abstract public function getDisplayName();
	
	/**
	 * @return string the artwork for this item
	 */
	public function getArtwork()
	{
		return $this->thumbnail;
	}

	/**
	 * Returns the list of genres as a string
	 * @return string
	 */
	public function getGenreString()
	{
		return implode(' / ', $this->genre);
	}

	/**
	 * @return string the plot for the item, or "Not available" if it's missing
	 */
	public function getPlot()
	{
		return !empty($this->plot) ? $this->plot : Yii::t('Misc', 'Not available');
	}

	/**
	 * @return boolean whether or not the item has a rating
	 */
	public function hasRating()
	{
		return !!$this->rating;
	}

	/**
	 * @return float the rating for the item (formatted)
	 */
	public function getRating()
	{
		return number_format($this->rating, 1);
	}

	/**
	 * @return string the runtime string or null if runtime is not available
	 */
	public function getRuntimeString()
	{
		return $this->runtime ? (int)($this->runtime / 60).' min' : null;
	}

}
