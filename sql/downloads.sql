SELECT
	d.download_id,
	d.filename,
	d.mask,
	dd.name,
	pd.product_id
FROM `oc_download` d
INNER JOIN `oc_download_description` dd ON dd.download_id = d.download_id AND dd.language_id=1
INNER JOIN `oc_product_to_download` pd ON pd.download_id = d.download_id
;